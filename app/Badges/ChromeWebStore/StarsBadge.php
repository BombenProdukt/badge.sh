<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/chrome-web-store/stars/{itemId}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $itemId): array
    {
        return (new RatingBadge($this->client))->handle($itemId);
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['score']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/chrome-web-store/stars/ckkdlimhmcjmikdlpkmbgfkaikojcbjk',
                data: $this->render(['score' => '4.5']),
                deprecated: true,
            ),
        ];
    }
}
