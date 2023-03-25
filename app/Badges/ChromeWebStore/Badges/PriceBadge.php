<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Enums\Category;
use Symfony\Component\DomCrawler\Crawler;

final class PriceBadge extends AbstractBadge
{
    protected array $routes = [
        '/chrome-web-store/price/{itemId}',
    ];

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
