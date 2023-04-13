<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class SuggestersBadge extends AbstractBadge
{
    protected string $route = '/packagist/suggesters/{vendor}/{project}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $vendor, string $project): array
    {
        return $this->client->get($vendor, $project);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('suggesters', $properties['suggesters']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'suggesters',
                path: '/packagist/suggesters/monolog/monolog',
                data: $this->render(['suggesters' => '1']),
            ),
        ];
    }
}
