<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class UploadBadge extends AbstractBadge
{
    protected array $routes = [
        '/whatpulse/upload/{userType:team,user}/{id}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $userType, string $id): array
    {
        return [
            'speed' => Arr::get($this->client->get($userType, $id), $userType === 'team' ? 'Team.Upload' : 'Upload'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('upload', $properties['speed'], 'green.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/whatpulse/upload/user/179734',
                data: $this->render(['speed' => '1024']),
            ),
        ];
    }
}
