<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class XLMBadge extends AbstractBadge
{
    protected array $routes = [
        '/keybase/xlm/{address}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $address): array
    {
        return [
            'address' => $this->client->get($address, 'stellar')['them']['stellar']['primary']['account_id'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'XLM',
            'message' => $properties['address'],
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'xlm address',
                path: '/keybase/xlm/skyplabs',
                data: $this->render([]),
            ),
        ];
    }
}
