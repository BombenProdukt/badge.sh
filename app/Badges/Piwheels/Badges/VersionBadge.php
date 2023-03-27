<?php

declare(strict_types=1);

namespace App\Badges\Piwheels\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/piwheels/version/{wheel}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $wheel): array
    {
        return [
            'version' => \array_key_first($this->client->get($wheel)['releases']),
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
                path: '/piwheels/version/numpy',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
