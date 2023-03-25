<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class SizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/size/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $owner, string $repo): array
    {
        return GitHub::connection()->repos()->show($owner, $repo);
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function previews(): array
    {
        return [
            '/github/size/micromatch/micromatch' => 'size',
        ];
    }
}
