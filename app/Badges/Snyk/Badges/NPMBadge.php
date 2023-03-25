<?php

declare(strict_types=1);

namespace App\Badges\Snyk\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NPMBadge extends AbstractBadge
{
    protected array $routes = [
        '/snyk/npm/{project}/{targetFile?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project, ?string $branch = null, ?string $targetFile = null): array
    {
        $svg = $this->client->get('test/npm/'.\implode('/', [$project, $branch]), $targetFile);

        \preg_match_all('/fill-opacity=[^>]*?>([^<]+)<\//i', $svg, $matchesText);
        [$label, $message] = $matchesText[1];

        if (!\preg_match('/<path[^>]*?fill="([^"]+)"[^>]*?d="M[^0]/i', $svg, $matchesColor)) {
            return [];
        }

        $messageColor = \trim(\str_replace('#', '', $matchesColor[1]));

        if (null === $message || empty($messageColor)) {
            return [];
        }

        return [
            'label' => $label,
            'message' => $message,
            'messageColor' => $messageColor,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'] ?? 'vulnerabilities',
            'message' => $properties['message'],
            'messageColor' => $properties['messageColor'],
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('targetFile', RoutePattern::CATCH_ALL->value);
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'vulnerability scan (branch)',
                path: '/snyk/npm/@babel/core',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'vulnerability scan (branch)',
                path: '/snyk/npm/@babel/core/6.x',
                data: $this->render([]),
            ),
        ];
    }
}
