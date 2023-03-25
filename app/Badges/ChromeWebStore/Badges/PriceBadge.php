<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Symfony\Component\DomCrawler\Crawler;

final class PriceBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/chrome-web-store/price/{itemId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $itemId): array
    {
        $crawler = new Crawler($this->client->get($itemId));

        return [
            'amount' => $crawler->filterXPath('//meta[@itemprop="price"]')->getNode(0)->attributes->getNamedItem('content')->textContent,
            'currency' => $crawler->filterXPath('//meta[@itemprop="priceCurrency"]')->getNode(0)->attributes->getNamedItem('content')->textContent,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderMoney('price', $properties['amount'], $properties['currency']);
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
            '/chrome-web-store/price/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'price',
        ];
    }
}
