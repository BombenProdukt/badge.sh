<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Badges\CocoaPods\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class PlatformBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $pod): array
    {
        return [
            'label'       => 'platform',
            'status'      => implode('|', array_keys($this->client->get($pod)['platforms'])),
            'statusColor' => 'gray.600',
        ];
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
            '/cocoapods/p/{pod}',
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
            '/cocoapods/p/AFNetworking' => 'platform',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
