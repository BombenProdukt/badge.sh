<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class LastModifiedBadge extends AbstractBadge
{
    protected string $route = '/ore/last-modified/{pluginId}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $pluginId): array
    {
        return [
            'date' => $this->client->get($pluginId)['last_updated'],
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
                name: 'license',
                path: '/ore/last-modified/nucleus',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
