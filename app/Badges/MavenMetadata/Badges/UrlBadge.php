<?php

declare(strict_types=1);

namespace App\Badges\MavenMetadata\Badges;

use App\Badges\AbstractBadge;
use App\Badges\MavenMetadata\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class UrlBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $hostname, string $pathname): array
    {
        $response = Http::get("https://{$hostname}/{$pathname}")->throw()->body();

        preg_match('/<latest>(?<version>.+)<\/latest>/', $response, $matches);

        return $this->renderVersion($matches[1]);
    }

    public function service(): string
    {
        return 'Maven Metadata';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/maven-metadata/version/{hostname}/{pathname}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('pathname', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/maven-metadata/version/repo1.maven.org/maven2/com/google/code/gson/gson/maven-metadata.xml' => 'version (maven metadata url)',
        ];
    }
}
