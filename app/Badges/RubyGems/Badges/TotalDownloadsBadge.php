<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Badges\RubyGems\Client;
use App\Badges\Templates\DownloadsTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $gem): array
    {
        return DownloadsTemplate::make($this->client->get("gems/{$gem}")['downloads']);
    }

    public function service(): string
    {
        return 'RubyGems';
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
            '/rubygems/downloads/{gem}',
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
            '/rubygems/downloads/rails' => 'total downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
