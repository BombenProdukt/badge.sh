<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Enums\Category;

final class LastModifiedBadge extends AbstractBadge
{
    protected array $routes = [
        '/factorio-mod-portal/last-modified/{modName}',
    ];

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
            '/factorio-mod-portal/last-modified/rso-mod' => 'factorio version',
        ];
    }
}
