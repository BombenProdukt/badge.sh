<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class PulsesBadge extends AbstractBadge
{
    protected string $route = '/whatpulse/pulses/{userType:team,user}/{id}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $userType, string $id): array
    {
        return [
            'count' => Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.Pulses' : 'Pulses'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('pulses', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/whatpulse/pulses/user/179734',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
