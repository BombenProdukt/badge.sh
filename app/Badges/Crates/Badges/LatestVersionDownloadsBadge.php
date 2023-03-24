<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LatestVersionDownloadsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($this->client->get($package)['recent_downloads']).' latest version',
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/crates/downloads-recently/{package}',
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
            '/crates/downloads-recently/regex' => 'downloads (latest version)',
        ];
    }
}
