<?php

declare(strict_types=1);

namespace App\Badges\LaravelForge\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/laravel-forge/status/{site}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $site): array
    {
        return $this->client->get($site);
    }

    public function render(array $properties): array
    {
        return $this->renderText($properties['label'] ?: 'status', $properties['message'], $properties['color']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'type',
                path: '/laravel-forge/status/5a0806b6-667d-46fe-bdf5-8a19ac545912',
                data: $this->render(['type' => 'project']),
            ),
        ];
    }
}