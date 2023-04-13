<?php

declare(strict_types=1);

namespace App\Badges\XO;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/xo/status/{name:wildcard}';

    protected array $keywords = [
        Category::CODE_FORMATTING,
    ];

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        if (empty($response['devDependencies']) || empty($response['devDependencies']['xo'])) {
            return [
                'status' => 'disabled',
            ];
        }

        return [
            'status' => 'enabled',
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['status'] === 'disabled') {
            return [
                'label' => 'xo',
                'message' => 'not enabled',
                'messageColor' => 'red.600',
            ];
        }

        return [
            'label' => 'code style',
            'message' => 'XO',
            'messageColor' => 'teal.400',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'semicolon',
                path: '/xo/status/chalk',
                data: $this->render(['status' => 'enabled']),
            ),
            new BadgePreviewData(
                name: 'status',
                path: '/xo/status/chalk',
                data: $this->render(['status' => 'disabled']),
            ),
            new BadgePreviewData(
                name: 'status',
                path: '/xo/status/@tusbar/cache-control',
                data: $this->render(['status' => 'enabled']),
            ),
            new BadgePreviewData(
                name: 'status',
                path: '/xo/status/@tusbar/cache-control',
                data: $this->render(['status' => 'disabled']),
            ),
        ];
    }
}
