<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Spatie\Regex\Regex;
use Symfony\Component\DomCrawler\Crawler;

final class RatingBadge extends AbstractBadge
{
    protected string $route = '/chrome-web-store/rating/{itemId}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $itemId): array
    {
        $textContent = (new Crawler($this->client->get($itemId)))
            ->filter('.bhAbjd')
            ->getNode(0)
            ->attributes
            ->getNamedItem('aria-label')
            ->textContent;

        return [
            'rating' => Regex::match('/Average rating (.*) out of 5/', $textContent)->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderRating('rating', $properties['rating']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating',
                path: '/chrome-web-store/rating/ckkdlimhmcjmikdlpkmbgfkaikojcbjk',
                data: $this->render(['rating' => '4.5']),
            ),
        ];
    }
}
