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
            'label'        => 'platform',
            'message'      => implode('|', array_keys($this->client->get($pod)['platforms'])),
            'messageColor' => 'gray.600',
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
            '/cocoapods/{pod}/platform',
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
            '/cocoapods/AFNetworking/platform' => 'platform',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}