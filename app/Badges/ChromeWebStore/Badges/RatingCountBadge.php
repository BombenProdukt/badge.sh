<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Badges\AbstractBadge;
use App\Badges\ChromeWebStore\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;
use Symfony\Component\DomCrawler\Crawler;

final class RatingCountBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $itemId): array
    {
        $textContent = (new Crawler($this->client->get($itemId)))
            ->filter('.bhAbjd')
            ->getNode(0)
            ->attributes
            ->getNamedItem('aria-label')
            ->textContent;

        return [
            'label'        => 'rating count',
            'message'      => Regex::match('/(\d+) users rated this item/', $textContent)->group(1),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Chrome Web Store';
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/chrome-web-store/rating-count/{itemId}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/chrome-web-store/rating-count/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'rating count',
        ];
    }
}
