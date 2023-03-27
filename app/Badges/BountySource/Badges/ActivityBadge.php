<?php

declare(strict_types=1);

namespace App\Badges\BountySource\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ActivityBadge extends AbstractBadge
{
    protected string $route = '/bountysource/activity/{team}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $team): array
    {
        return [
            'count' => $this->client->get($team)['activity_total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('activity', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'activity',
                path: '/bountysource/activity/mozilla-core',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
