<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Enums\Category;

final class TreeBadge extends AbstractBadge
{
    protected array $routes = [
        '/ecologi/trees/{username}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $username): array
    {
        return [
            'count' => $this->client->trees($username),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('trees', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/ecologi/trees/ecologi' => 'license',
        ];
    }
}
