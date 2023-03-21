<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Badges\Snapcraft\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ArchitectureBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $snap): array
    {
        return [
            'label'        => 'architecture',
            'message'      => collect($this->client->get($snap)['channel-map'])->map->channel->map->architecture->unique()->implode(' | '),
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Snapcraft';
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
            '/snapcraft/architecture/{snap}',
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
            '/snapcraft/architecture/telegram-desktop' => 'supported architectures',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
