<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/modrinth/version/{projectId}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/modrinth/version/AANobbMI',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
