<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DependentsBadge extends AbstractBadge
{
    public function handle(string $shard): array
    {
        preg_match('/Dependents[^>]*? class="count">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'        => 'dependents',
            'message'      => FormatNumber::execute((int) $matches[1]),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/shardbox/dependents/{shard}',
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
            '/shardbox/dependents/lucky' => 'dependents',
        ];
    }
}
