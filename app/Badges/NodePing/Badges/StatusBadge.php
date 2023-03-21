<?php

declare(strict_types=1);

namespace App\Badges\NodePing\Badges;

use App\Badges\NodePing\Client;
use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $uuid): array
    {
        $isOnline = $this->client->status($uuid);

        return TextTemplate::make('status', $isOnline ? 'online' : 'offline', $isOnline ? 'green.600' : 'red.600');
    }

    public function service(): string
    {
        return 'NodePing';
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
            '/nodeping/status/{uuid}',
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
            '/nodeping/status/jkiwn052-ntpp-4lbb-8d45-ihew6d9ucoei' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
