<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Enums\Category;

final class ReleaseDateBadge extends AbstractBadge
{
    protected array $routes = [
        '/vs-marketplace/release-date/{extension}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extension): array
    {
        return [
            'date' => $this->client->get($extension)['releaseDate'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('release date', $properties['date']);
    }

    public function previews(): array
    {
        return [
            '/vs-marketplace/release-date/vscodevim.vim' => 'release date',
        ];
    }
}
