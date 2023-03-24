<?php

declare(strict_types=1);

namespace App\Badges\Snyk\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NPMBadge extends AbstractBadge
{
    public function handle(string $project, ?string $branch = null, ?string $targetFile = null): array
    {
        $svg = $this->client->get('test/npm/'.implode('/', [$project, $branch]), $targetFile);

        preg_match_all('/fill-opacity=[^>]*?>([^<]+)<\//i', $svg, $matchesText);
        [$label, $message] = $matchesText[1];

        if (! preg_match('/<path[^>]*?fill="([^"]+)"[^>]*?d="M[^0]/i', $svg, $matchesColor)) {
            return [];
        }

        $messageColor = trim(str_replace('#', '', $matchesColor[1]));

        if (is_null($message) || empty($messageColor)) {
            return [];
        }

        return [
            'label'        => $label,
            'message'      => $message,
            'messageColor' => $messageColor,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => $properties['label'] ?? 'vulnerabilities',
            'message'      => $properties['message'],
            'messageColor' => $properties['messageColor'],
        ];
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
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
