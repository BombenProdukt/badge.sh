<?php

declare(strict_types=1);

namespace App\Badges\Repology\Badges;

use App\Enums\Category;
use Spatie\Regex\Regex;

final class RepositoryCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/repology/repositories/{packageName}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $packageName): array
    {
        return [
            'count' => Regex::match('|<text x="105.0" y="15" fill="#010101" fill-opacity=".3" text-anchor="middle">(\d+)</text>|', $this->client->count($packageName))->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('repositories', $properties['count']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/repology/repositories/starship' => 'repository count',
        ];
    }
}
