<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Enums\Category;

final class LastUpdateBadge extends AbstractBadge
{
    protected array $routes = [
        '/vs-marketplace/last-modified/{extension}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $extension): array
    {
        return [
            'date' => $this->client->get($extension)['lastUpdated'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('last modified', $properties['date']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/vs-marketplace/last-modified/vscodevim.vim' => 'last updated',
        ];
    }
}
