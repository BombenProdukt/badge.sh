<?php

declare(strict_types=1);

namespace App\Badges\Netlify\Badges;

use App\Badges\Netlify\Client;
use App\Badges\Templates\StatusTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId): array
    {
        $status = $this->client->status($projectId);

        if (str_contains($status, '#0F4A21')) {
            $status = 'passing';
        }

        if (str_contains($status, '#800A20')) {
            $status = 'failing';
        }

        if (str_contains($status, '#603408')) {
            $status = 'building';
        }

        return StatusTemplate::make('build', $status);
    }

    public function service(): string
    {
        return 'Netlify';
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
            '/netlify/status/{projectId}',
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
            '/netlify/status/e6d5a4e0-dee1-4261-833e-2f47f509c68f' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
