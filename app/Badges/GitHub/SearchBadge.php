<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class SearchBadge extends AbstractBadge
{
    protected string $route = '/github/search/{owner}/{repo}/{query}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $owner, string $repo, string $query): array
    {
        return [
            'query' => "{$query} counter",
            'count' => GitHub::search()->code("{$query} repo:{$owner}/{$repo}")['total_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['query'], $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'search',
                path: '/github/search/torvalds/linux/goto',
                data: $this->render(['query' => 'goto', 'count' => 0]),
            ),
        ];
    }
}
