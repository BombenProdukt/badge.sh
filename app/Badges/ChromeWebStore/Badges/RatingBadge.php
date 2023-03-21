<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Badges\ChromeWebStore\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;
use Symfony\Component\DomCrawler\Crawler;

final class RatingBadge implements Badge
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
            'label'        => 'rating',
            'message'      => Regex::match('/Average rating (.*) out of 5/', $textContent)->group(1),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Chrome Web Store';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/chrome-web-store/rating/{itemId}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/chrome-web-store/rating/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'rating',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
