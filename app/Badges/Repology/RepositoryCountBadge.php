<?php

declare(strict_types=1);

namespace App\Badges\Repology;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Spatie\Regex\Regex;

final class RepositoryCountBadge extends AbstractBadge
{
    protected string $route = '/repology/repositories/{packageName}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'repository count',
                path: '/repology/repositories/starship',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
