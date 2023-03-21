<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Badges\MozillaAddOns\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatStars;

final class StarsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'        => 'stars',
            'message'      => FormatStars::execute($response['ratings']['average']),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Mozilla Add-ons';
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
            '/amo/stars/{package}',
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
            '/amo/stars/markdown-viewer-chrome' => 'stars',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
