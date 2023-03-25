<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UsersBadge extends AbstractBadge
{
    protected array $routes = [
        '/chrome-web-store/users/{itemId}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $itemId): array
    {
        \preg_match('|<span class="e-f-ih" title="(.*?)">(.*?)</span>|', $this->client->get($itemId), $matches);

        return [
            'count' => \filter_var($matches[1], \FILTER_SANITIZE_NUMBER_INT),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'users',
                path: '/chrome-web-store/users/ckkdlimhmcjmikdlpkmbgfkaikojcbjk',
                data: $this->render([]),
            ),
        ];
    }
}
