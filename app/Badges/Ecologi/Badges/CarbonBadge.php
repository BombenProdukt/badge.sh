<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Enums\Category;

final class CarbonBadge extends AbstractBadge
{
    protected array $routes = [
        '/ecologi/carbon/{username}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $username): array
    {
        return [
            'count' => $this->client->carbon($username),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('carbon offset', $properties['count']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/ecologi/carbon/ecologi' => 'license',
        ];
    }
}
