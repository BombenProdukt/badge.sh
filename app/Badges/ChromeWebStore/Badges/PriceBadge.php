<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Badges\ChromeWebStore\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatMoney;
use Symfony\Component\DomCrawler\Crawler;

final class PriceBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $itemId): array
    {
        $crawler       = new Crawler($this->client->get($itemId));
        $price         = $crawler->filterXPath('//meta[@itemprop="price"]')->getNode(0)->attributes->getNamedItem('content')->textContent;
        $priceCurrency = $crawler->filterXPath('//meta[@itemprop="priceCurrency"]')->getNode(0)->attributes->getNamedItem('content')->textContent;

        return [
            'label'       => 'price',
            'status'      => FormatMoney::execute($price, $priceCurrency),
            'statusColor' => 'green.600',
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
            '/chrome-web-store/price/{itemId}',
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
            '/chrome-web-store/price/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'price',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
