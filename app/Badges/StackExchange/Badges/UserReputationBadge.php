<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UserReputationBadge extends AbstractBadge
{
    public function handle(string $site, string $query): array
    {
        return $this->client->user($site, $query);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('reputation', $properties['reputation']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/stack-exchange/user/reputation/{site}/{query}',
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
            '/stack-exchange/user/reputation/stackoverflow/123' => 'reputation',
        ];
    }
}
