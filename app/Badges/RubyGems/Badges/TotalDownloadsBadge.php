<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Badges\AbstractBadge;
use App\Badges\RubyGems\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $gem): array
    {
        return $this->renderDownloads($this->client->get("gems/{$gem}")['downloads']);
    }

    public function service(): string
    {
        return 'RubyGems';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/rubygems/downloads/{gem}',
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
            '/rubygems/downloads/rails' => 'total downloads',
        ];
    }
}
