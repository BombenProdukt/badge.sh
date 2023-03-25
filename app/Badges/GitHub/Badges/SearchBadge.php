<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class SearchBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/search/{owner}/{repo}/{query}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $owner, string $repo, string $query): array
    {
        return [
            'label' => "{$query} counter",
            'count' => GitHub::search()->code("{$query} repo:{$owner}/{$repo}")['total_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['label'], $properties['count']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/search/torvalds/linux/goto' => 'search',
        ];
    }
}
