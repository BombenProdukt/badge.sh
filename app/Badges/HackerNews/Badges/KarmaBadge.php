<?php

declare(strict_types=1);

namespace App\Badges\HackerNews\Badges;

use App\Badges\AbstractBadge;
use App\Badges\HackerNews\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class KarmaBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        return $this->renderNumber("u/{$username} karma", $this->client->karma($username));
    }

    public function service(): string
    {
        return 'Hacker News';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/hackernews/karma/{username}',
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
            '/hackernews/karma/pg' => 'karma',
        ];
    }
}
