<?php

declare(strict_types=1);

namespace App\Badges\NPMS\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PopularityScoreBadge extends AbstractBadge
{
    protected array $routes = [
        '/npms/popularity-score/{package}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $package): array
    {
        return $this->client->get($package)['detail'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('popularity', $properties['popularity']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'popularity score',
                path: '/npms/popularity-score/chalk',
                data: $this->render([]),
            ),
        ];
    }
}
