<?php

declare(strict_types=1);

namespace App\Badges\GalaxyToolShed\Badges;

use App\Enums\Category;

final class ReleaseDateBadge extends AbstractBadge
{
    protected array $routes = [
        '/galaxy-tool-shed/release-date/{user}/{repo}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

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
