<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class DownloadBadge extends AbstractBadge
{
    protected string $route = '/whatpulse/download/{userType:team,user}/{id}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/whatpulse/download/user/179734',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
