<?php

declare(strict_types=1);

namespace App\Badges\Ansible\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RoleBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/ansible/role/{roleId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/ansible/role/3078' => 'downloads',
        ];
    }
}
