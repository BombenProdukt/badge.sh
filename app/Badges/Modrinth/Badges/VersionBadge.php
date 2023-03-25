<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/modrinth/version/{projectId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $projectId): array
    {
        return [
            'version' => $this->client->version($projectId)['version_number'],
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
            '/modrinth/version/AANobbMI' => 'version',
        ];
    }
}
