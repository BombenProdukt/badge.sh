<?php

declare(strict_types=1);

namespace App\Badges\Ansible\Badges;

use App\Enums\Category;

final class RoleBadge extends AbstractBadge
{
    protected array $routes = [
        '/ansible/role/{roleId}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $roleId): array
    {
        return [
            'count' => $this->client->roles($roleId)['download_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['count']);
    }

    public function previews(): array
    {
        return [
            '/ansible/role/3078' => 'downloads',
        ];
    }
}
