<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Enums\Category;
use Spatie\Regex\Regex;
use Symfony\Component\DomCrawler\Crawler;

final class RatingCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/chrome-web-store/rating-count/{itemId}',
    ];

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
            'count' => Regex::match('/(\d+) users rated this item/', $textContent)->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'rating count',
            'message' => $properties['count'],
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            '/chrome-web-store/rating-count/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'rating count',
        ];
    }
}
