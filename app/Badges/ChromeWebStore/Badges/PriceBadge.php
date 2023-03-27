<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Symfony\Component\DomCrawler\Crawler;

final class PriceBadge extends AbstractBadge
{
    protected string $route = '/chrome-web-store/price/{itemId}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'price',
                path: '/chrome-web-store/price/ckkdlimhmcjmikdlpkmbgfkaikojcbjk',
                data: $this->render(['amount' => '0', 'currency' => 'USD']),
            ),
        ];
    }
}
