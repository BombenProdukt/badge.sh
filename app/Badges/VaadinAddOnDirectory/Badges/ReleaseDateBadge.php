<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ReleaseDateBadge extends AbstractBadge
{
    protected array $routes = [
        '/vaadin/release-date/{packageName}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $packageName): array
    {
        return [
            'date' => $this->client->get($packageName)['latestAvailableRelease']['publicationDate'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('release date', $properties['date']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'release date',
                path: '/vaadin/release-date/vaadinvaadin-grid',
                data: $this->render([]),
            ),
        ];
    }
}
