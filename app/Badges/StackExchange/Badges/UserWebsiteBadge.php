<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UserWebsiteBadge extends AbstractBadge
{
    protected array $routes = [
        '/stack-exchange/user/website/{site}/{query}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $site, string $query): array
    {
        return [
            'url' => $this->client->user($site, $query)['website_url'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('website', $properties['url']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'website',
                path: '/stack-exchange/user/website/stackoverflow/123',
                data: $this->render([]),
            ),
        ];
    }
}
