<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Enums\Category;

final class PatronsBadge extends AbstractBadge
{
    protected array $routes = [
        '/liberapay/patrons/{username}',
    ];

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $username): array
    {
        return [
            'count' => $this->client->get($username)['npatrons'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('patrons', $properties['count']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/liberapay/patrons/microG' => 'patrons count',
        ];
    }
}
