<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Enums\Category;

final class LastModifiedBadge extends AbstractBadge
{
    protected array $routes = [
        '/eclipse-marketplace/last-modified/{name}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $name): array
    {
        return [
            'date' => $this->client->get($name)->filterXPath('//changed')->text(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last modified', $properties['date']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/eclipse-marketplace/last-modified/notepad4e' => 'last modified',
        ];
    }
}
