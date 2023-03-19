<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Badges\Haxelib\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LatestDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $response = $this->client->get($project);

        return [
            'label'        => 'TODO',
            'message'      => 'TODO',
            'messageColor' => 'TODO',
        ];
    }

    public function service(): string
    {
        return 'Haxelib';
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
            '/haxelib/{project}/downloads/latest',
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
        //
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
            '/haxelib/hxnodejs/downloads/latest' => 'downloads (latest version)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
