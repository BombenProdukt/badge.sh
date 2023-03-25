<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;

final class SizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/cpan/size/{distribution}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $distribution): array
    {
        return $this->client->get("release/{$distribution}")['stat'];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function previews(): array
    {
        return [
            '/cpan/size/Moose' => 'size',
        ];
    }
}
