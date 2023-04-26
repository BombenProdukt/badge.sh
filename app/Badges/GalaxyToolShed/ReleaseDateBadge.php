<?php

declare(strict_types=1);

namespace App\Badges\GalaxyToolShed;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class ReleaseDateBadge extends AbstractBadge
{
    protected string $route = '/galaxy-tool-shed/release-date/{user}/{repo}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'release date',
                path: '/galaxy-tool-shed/release-date/iuc/sra_tools',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
