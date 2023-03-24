<?php

declare(strict_types=1);

namespace App\Badges\NYCRC\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LinesBadge extends AbstractBadge
{
    public function handle(string $user, string $repo): array
    {
        return $this->renderText('lines', $this->client->get($user, $repo)['lines'] ?? 0);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/nycrc/lines/{user}/{repo}',
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
            '/nycrc/lines/yargs/yargs' => 'lines',
        ];
    }
}
