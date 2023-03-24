<?php

declare(strict_types=1);

namespace App\Badges\Ansible\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RoleBadge extends AbstractBadge
{
    public function handle(string $roleId): array
    {
        return $this->renderDownloads($this->client->roles($roleId)['download_count']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/ansible/role/{roleId}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
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
