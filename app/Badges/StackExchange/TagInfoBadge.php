<?php

declare(strict_types=1);

namespace App\Badges\StackExchange;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TagInfoBadge extends AbstractBadge
{
    protected string $route = '/stack-exchange/tag-info/{site}/{query}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $site, string $query): array
    {
        return [
            'query' => $query,
            'site' => $site,
            'count' => $this->client->tags($site, $query)['count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['query'].'@'.$properties['site'], $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'tag info',
                path: '/stack-exchange/tag-info/{package}',
                data: $this->render(['query' => 'package', 'site' => 'stackoverflow', 'count' => '1000000']),
            ),
        ];
    }
}
