<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class UsersBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'        => 'users',
            'message'      => FormatNumber::execute($response['average_daily_users']),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS, Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/amo/users/{package}',
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
            '/amo/users/markdown-viewer-chrome' => 'users',
        ];
    }
}
