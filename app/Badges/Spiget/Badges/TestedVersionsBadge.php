<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Enums\Category;

final class TestedVersionsBadge extends AbstractBadge
{
    protected array $routes = [
        '/spiget/tested-versions/{resourceId}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/spiget/tested-versions/9089' => 'tested versions',
        ];
    }
}
