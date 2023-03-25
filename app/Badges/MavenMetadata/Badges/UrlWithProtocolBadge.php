<?php

declare(strict_types=1);

namespace App\Badges\MavenMetadata\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class UrlWithProtocolBadge extends AbstractBadge
{
    protected array $routes = [
        '/maven-metadata/version/{protocol}/{hostname}/{pathname}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $protocol, string $hostname, string $pathname): array
    {
        $response = Http::get("{$protocol}://{$hostname}/{$pathname}")->throw()->body();

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
        $route->where('protocol', 'https?:?');
        $route->where('pathname', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/maven-metadata/version/https/repo1.maven.org/maven2/com/google/code/gson/gson/maven-metadata.xml',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
