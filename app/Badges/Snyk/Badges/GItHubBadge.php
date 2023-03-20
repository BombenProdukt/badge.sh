<?php

declare(strict_types=1);

namespace App\Badges\Snyk\Badges;

use App\Badges\Snyk\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GItHubBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project, string $targetFile = null): array
    {
        $svg = $this->client->get("test/github/{$project}", $targetFile);

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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/snyk/{project}/github/{targetFile?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('targetFile', RoutePattern::CATCH_ALL->value);
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/snyk/badges/shields/github/badge-maker/package.json' => 'vulnerability scan',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}