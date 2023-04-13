<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class ReleaseDateBadge extends AbstractBadge
{
    protected string $route = '/vaadin/release-date/{packageName}';

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
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
