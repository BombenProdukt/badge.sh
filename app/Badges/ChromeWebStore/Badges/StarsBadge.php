<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Badges\ChromeWebStore\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatStars;

final class StarsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $itemId): array
    {
        return [
            'label'        => 'stars',
            'message'      => FormatStars::execute((new RatingBadge($this->client))->handle($itemId)['status']),
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
            '/chrome-web-store/stars/{itemId}',
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
            '/chrome-web-store/stars/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'stars',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
