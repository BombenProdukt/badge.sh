<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class DownloadBadge extends AbstractBadge
{
    public function handle(string $userType, string $id): array
    {
        return [
            'downloads' => Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.Download' : 'Download'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/whatpulse/download/{userType}/{id}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('userType', ['user', 'team']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/whatpulse/download/user/179734' => 'license',
        ];
    }
}
