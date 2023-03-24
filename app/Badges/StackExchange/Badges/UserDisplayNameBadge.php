<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UserDisplayNameBadge extends AbstractBadge
{
    public function handle(string $site, string $query): array
    {
        return $this->renderText('display-name', $this->client->user($site, $query)['display_name']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/stack-exchange/user/display-name/{site}/{query}',
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
            '/stack-exchange/user/display-name/stackoverflow/123' => 'display-name',
        ];
    }
}
