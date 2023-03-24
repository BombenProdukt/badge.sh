<?php

declare(strict_types=1);

namespace App\Badges\GalaxyToolShed\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReleaseDateBadge extends AbstractBadge
{
    public function handle(string $user, string $repo): array
    {
        return [
            'date' => $this->client->fetchLastOrderedInstallableRevisionsSchema($user, $repo)['create_time'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('release date', $properties['date']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/galaxy-tool-shed/release-date/{user}/{repo}',
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
            '/galaxy-tool-shed/release-date/iuc/sra_tools' => 'release date',
        ];
    }
}
