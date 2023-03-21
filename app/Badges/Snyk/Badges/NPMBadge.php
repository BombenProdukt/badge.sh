<?php

declare(strict_types=1);

namespace App\Badges\Snyk\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Snyk\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NPMBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project, ?string $branch = null, ?string $targetFile = null): array
    {
        $svg = $this->client->get('test/npm/'.implode('/', [$project, $branch]), $targetFile);

        preg_match_all('/fill-opacity=[^>]*?>([^<]+)<\//i', $svg, $matchesText);
        [$subject, $status] = $matchesText[1];

        if (! preg_match('/<path[^>]*?fill="([^"]+)"[^>]*?d="M[^0]/i', $svg, $matchesColor)) {
            return [];
        }

        $statusColor = trim(str_replace('#', '', $matchesColor[1]));

        if (is_null($status) || empty($statusColor)) {
            return [];
        }

        return [
            'label'        => $subject ?? 'vulnerabilities',
            'message'      => $status,
            'messageColor' => $statusColor,
        ];
    }

    public function service(): string
    {
        return 'Snyk';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/snyk/npm/{project}/{targetFile?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('targetFile', RoutePattern::CATCH_ALL->value);
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/snyk/npm/@babel/core'     => 'vulnerability scan (branch)',
            '/snyk/npm/@babel/core/6.x' => 'vulnerability scan (branch)',
        ];
    }
}
