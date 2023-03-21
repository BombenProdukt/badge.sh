<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Badges\ChromeWebStore\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $itemId): array
    {
        preg_match('|<span class="C-b-p-D-Xe h-C-b-p-D-md">(.*?)</span>|', $this->client->get($itemId), $matches);

        return VersionTemplate::make($this->service(), $matches[1]);
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
            '/chrome-web-store/version/{itemId}',
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
            '/chrome-web-store/version/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
