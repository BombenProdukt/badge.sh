<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class LastModifiedBadge extends AbstractBadge
{
    protected array $routes = [
        '/aur/last-modified/{package}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $package): array
    {
        return [
            'date' => $this->client->get($package)['LastModified'],
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
                name: 'last modified',
                path: '/aur/last-modified/google-chrome',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
