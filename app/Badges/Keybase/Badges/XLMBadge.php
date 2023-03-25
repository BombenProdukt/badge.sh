<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

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
            '/keybase/xlm/skyplabs' => 'xlm address',
        ];
    }
}
