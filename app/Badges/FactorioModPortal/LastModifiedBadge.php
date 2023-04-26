<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class LastModifiedBadge extends AbstractBadge
{
    protected string $route = '/factorio-mod-portal/last-modified/{modName}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $modName): array
    {
        return [
            'date' => $this->client->latestRelease($modName)['released_at'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('last modified', $properties['date']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'factorio version',
                path: '/factorio-mod-portal/last-modified/rso-mod',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
