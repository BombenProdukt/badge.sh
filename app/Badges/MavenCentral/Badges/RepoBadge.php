<?php

declare(strict_types=1);

namespace App\Badges\MavenCentral\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RepoBadge extends AbstractBadge
{
    protected array $routes = [
        '/maven-central/version/{group}/{artifact}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $group, string $artifact): array
    {
        $response = $this->client->get(\str_replace('.', '/', $group)."/{$artifact}/maven-metadata.xml");

        \preg_match('/<latest>(?<version>.+)<\/latest>/', $response, $matches);

        return [
            'version' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('pathname', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/maven-central/version/com.google.code.gson/gson',
                data: $this->render([]),
            ),
        ];
    }
}
