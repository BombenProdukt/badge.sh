<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Badges\Haxelib\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $response = $this->client->get($project);

        return VersionTemplate::make($this->service(), 'TODO');
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
            '/haxelib/{project}/version',
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
            '/haxelib/tink_http/version' => 'version',
            '/haxelib/nme/version'       => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
