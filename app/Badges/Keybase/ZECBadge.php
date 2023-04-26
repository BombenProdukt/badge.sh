<?php

declare(strict_types=1);

namespace App\Badges\Keybase;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ZECBadge extends AbstractBadge
{
    protected string $route = '/keybase/zec/{address}';

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
                data: $this->render(['address' => 'zs1z7rejlpsa98s2rrrfkwmaxu53e4ue0ulcrw0h4x5g8jl04tak0d3mm47vdtahatqrlkngh9sly']),
            ),
        ];
    }
}
