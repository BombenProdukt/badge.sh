<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class ReleaseDateBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/release-date/{extension:wildcard}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extension): array
    {
        return [
            'date' => $this->client->get($extension)['timestamp'],
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
                path: '/open-vsx/release-date/idleberg/electron-builder',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
