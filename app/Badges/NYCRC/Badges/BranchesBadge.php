<?php

declare(strict_types=1);

namespace App\Badges\NYCRC\Badges;

use App\Badges\AbstractBadge;
use App\Badges\NYCRC\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class BranchesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user, string $repo): array
    {
        return $this->renderText('branches', $this->client->get($user, $repo)['branches'] ?? 0);
    }

    public function service(): string
    {
        return '.nycrc';
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/nycrc/branches/{user}/{repo}',
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
            '/nycrc/branches/yargs/yargs' => 'branches',
        ];
    }
}