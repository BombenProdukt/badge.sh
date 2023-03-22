<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Badges\AbstractBadge;
use App\Badges\StackExchange\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class UserWebsiteBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $site, string $query): array
    {
        return $this->renderText('website', $this->client->user($site, $query)['website_url']);
    }

    public function service(): string
    {
        return 'Stack Exchange';
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