<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/pypi/version/{project}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project): array
    {
        return $this->client->get($project)['info'];
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
            '/pypi/version/pip' => 'version',
            '/pypi/version/docutils' => 'version',
        ];
    }
}
