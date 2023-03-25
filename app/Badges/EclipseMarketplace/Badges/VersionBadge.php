<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/eclipse-marketplace/version/{name}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $name): array
    {
        return [
            'version' => $this->client->get($name)->filterXPath('//version')->text(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/eclipse-marketplace/version/notepad4e' => 'version',
        ];
    }
}
