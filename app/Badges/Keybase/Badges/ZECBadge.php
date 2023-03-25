<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ZECBadge extends AbstractBadge
{
    protected array $routes = [
        '/keybase/zec/{address}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $address): array
    {
        return [
            'address' => $this->client->get($address, 'cryptocurrency_addresses'),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'ZCash',
            'message' => $properties['address'],
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'zec address',
                path: '/keybase/zec/skyplabs',
                data: $this->render([]),
            ),
        ];
    }
}
