<?php

declare(strict_types=1);

namespace App\Badges\Tokei\Badges;

use App\Enums\Category;

final class LinesBadge extends AbstractBadge
{
    protected array $routes = [
        '/tokei/lines/{provider}/{user}/{repo}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $provider, string $user, string $repo): array
    {
        return [
            'lines' => $this->client->lines($provider, $user, $repo),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLines($properties['lines']);
    }

    public function previews(): array
    {
        return [
            '/tokei/lines/github/badges/shields' => 'version',
        ];
    }
}
