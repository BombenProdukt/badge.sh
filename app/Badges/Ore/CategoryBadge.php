<?php

declare(strict_types=1);

namespace App\Badges\Ore;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CategoryBadge extends AbstractBadge
{
    protected string $route = '/ore/category/{pluginId}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['category'];
    }

    public function render(array $properties): array
    {
        return $this->renderText('category', $properties['title']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'category',
                path: '/ore/category/nucleus',
                data: $this->render(['title' => 'Nucleus']),
            ),
        ];
    }
}
