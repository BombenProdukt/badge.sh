<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class ClicksBadge extends AbstractBadge
{
    protected string $route = '/whatpulse/clicks/{userType:team,user}/{id}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $userType, string $id): array
    {
        return [
            'count' => Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.Clicks' : 'Clicks'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('clicks', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/whatpulse/clicks/user/179734',
                data: $this->render(['count' => 1]),
            ),
        ];
    }
}
