<?php

declare(strict_types=1);

namespace App\Badges\Badgesize\Badges;

use App\Badges\Badgesize\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GitHubBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $compression, string $repo, string $path): array
    {
        $response = $this->client->get($compression, "{$repo}/{$path}");

        return [
            'label'        => $compression === 'normal' ? 'size' : "{$compression} size",
            'message'      => $response['prettySize'],
            'messageColor' => $response['color'],
        ];
    }

    public function service(): string
    {
        return 'Badgesize';
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
            '/badgesize/{compression}/{repo}/{path}',
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
        $route->whereIn('compression', ['brotli', 'gzip', 'normal']);
        $route->where('repo', RoutePattern::CATCH_ALL->value);
        $route->where('path', RoutePattern::CATCH_ALL->value);
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
            '/badgesize/normal/amio/emoji.json/master/emoji-compact.json' => 'normal size',
            '/badgesize/gzip/amio/emoji.json/master/emoji-compact.json'   => 'gzip size',
            '/badgesize/brotli/amio/emoji.json/master/emoji-compact.json' => 'brotli size',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
