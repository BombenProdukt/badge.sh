<?php

declare(strict_types=1);

namespace App\Badges\Piwheels\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/piwheels/version/{wheel}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/piwheels/version/numpy' => 'version',
        ];
    }
}
