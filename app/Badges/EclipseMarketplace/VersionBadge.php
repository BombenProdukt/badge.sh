<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/eclipse-marketplace/version/{name}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/eclipse-marketplace/version/notepad4e',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
