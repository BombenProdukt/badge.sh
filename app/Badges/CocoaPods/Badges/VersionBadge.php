<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Badges\CocoaPods\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $pod): array
    {
        $response = $this->client->get($pod);

        return VersionTemplate::make($this->service(), $response['version']);
    }

    public function service(): string
    {
        return 'CocoaPods';
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
            '/cocoapods/version/{pod}',
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
            '/cocoapods/version/AFNetworking' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
