<?php

declare(strict_types=1);

namespace App\Badges\Badgesize\Badges;

use App\Badges\Badgesize\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class GitHubBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $compression, string $owner, string $repo, string $path): array
    {
        $response = $this->client->get($compression, "{$owner}/{$repo}/{$path}");

        return [
            'label'       => $compression === 'normal' ? 'size' : "{$compression} size",
            'status'      => $response['prettySize'],
            'statusColor' => $response['color'],
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
            '/badgesize/{compression}/{owner}/{repo}/{path}',
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
        $route->where('owner', '^(?!.*\bfile-url\b).*$');
        $route->where('path', '.+');
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
