<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class LastModifiedBadge extends AbstractBadge
{
    protected string $route = '/eclipse-marketplace/last-modified/{name}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'last modified',
                path: '/eclipse-marketplace/last-modified/notepad4e',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
