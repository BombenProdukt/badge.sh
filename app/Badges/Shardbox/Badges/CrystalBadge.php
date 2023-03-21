<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Shardbox\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class CrystalBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $shard): array
    {
        preg_match('/Crystal<\\/span>\\s*<span[^>]*?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'        => 'crystal',
            'message'      => html_entity_decode($matches[1]),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Shardbox';
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/shardbox/crystal-version/{shard}',
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
            '/shardbox/crystal-version/amber' => 'crystal version',
        ];
    }
}
