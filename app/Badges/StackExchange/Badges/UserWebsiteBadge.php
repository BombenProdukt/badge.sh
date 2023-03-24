<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UserWebsiteBadge extends AbstractBadge
{
    public function handle(string $site, string $query): array
    {
        return [
            'url' => $this->client->user($site, $query)['website_url'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('website', $properties['url']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/stack-exchange/user/website/{site}/{query}',
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
            '/stack-exchange/user/website/stackoverflow/123' => 'website',
        ];
    }
}
