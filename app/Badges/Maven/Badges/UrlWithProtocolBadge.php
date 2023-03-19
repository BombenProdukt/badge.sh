<?php

declare(strict_types=1);

namespace App\Badges\Maven\Badges;

use App\Badges\Maven\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class UrlWithProtocolBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $protocol, string $hostname, string $pathname): array
    {
        $response = Http::get("{$protocol}://{$hostname}/{$pathname}")->throw()->body();

        preg_match('/<latest>(?<version>.+)<\/latest>/', $response, $matches);

        return VersionTemplate::make($this->service(), $matches[1]);
    }

    public function service(): string
    {
        return 'Maven';
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
            // TODO
            '/maven/v/metadata-url/{protocol}/{hostname}/{pathname}',
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
        $route->where('protocol', 'https?:?');
        $route->where('pathname', RoutePattern::CATCH_ALL->value);
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
            '/maven/v/metadata-url/https/repo1.maven.org/maven2/com/google/code/gson/gson/maven-metadata.xml' => 'version (maven metadata url)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
