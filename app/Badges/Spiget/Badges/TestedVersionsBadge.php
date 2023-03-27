<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TestedVersionsBadge extends AbstractBadge
{
    protected string $route = '/spiget/tested-versions/{resourceId}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $resourceId): array
    {
        $testedVersions = $this->client->resource($resourceId)['testedVersions'];

        return [
            'earliest' => $testedVersions[0],
            'latest' => \end($testedVersions),
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['earliest'] === $properties['latest']) {
            return $this->renderVersion($properties['earliest']);
        }

        return $this->renderVersion($properties['earliest'].'-'.$properties['latest'], 'tested versions');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'tested versions',
                path: '/spiget/tested-versions/9089',
                data: $this->render(['earliest' => '1.16.5', 'latest' => '1.16.5']),
            ),
        ];
    }
}
