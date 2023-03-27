<?php

declare(strict_types=1);

namespace App\Badges\Tidelift\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/tidelift/status/{platform}/{name}';

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $platform, string $name): array
    {
        return [
            'location' => $this->client->get($platform, $name),
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['location'])) {
            return [
                'label' => 'tidelift',
                'message' => 'not found',
                'messageColor' => 'red.600',
            ];
        }

        [, $status, $statusColor] = \explode('-', \parse_url(\urldecode($properties['location']))['path']);

        return [
            'label' => 'tidelift',
            'message' => \str_replace('!', '', $status),
            'messageColor' => \str_replace('.svg', '', $statusColor),
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'subscription',
                path: '/tidelift/status/npm/minimist',
                data: $this->render(['status' => 'success']),
            ),
            new BadgePreviewData(
                name: 'subscription',
                path: '/tidelift/status/npm/got',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
