<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class LastModifiedBadge extends AbstractBadge
{
    protected string $route = '/package-control/last-modified/{packageName}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return [
            'date' => $this->client->get($packageName)['last_modified'],
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
                path: '/package-control/last-modified/GitGutter',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
