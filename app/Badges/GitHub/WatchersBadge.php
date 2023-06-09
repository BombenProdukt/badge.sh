<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class WatchersBadge extends AbstractBadge
{
    protected string $route = '/github/watchers/{owner}/{repo}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'watchers' => $this->client->makeRepoQuery($owner, $repo, 'watchers { totalCount }')['watchers']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'watchers',
            'message' => FormatNumber::execute((float) $properties['watchers']),
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'watchers',
                path: '/github/watchers/micromatch/micromatch',
                data: $this->render(['watchers' => '1000000']),
            ),
        ];
    }
}
