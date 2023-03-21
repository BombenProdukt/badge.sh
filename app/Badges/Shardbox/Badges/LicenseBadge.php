<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Shardbox\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $shard): array
    {
        preg_match('/opensource.org\\/licenses\\/[^>]+?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return $this->renderLicense($matches[1]);
    }

    public function service(): string
    {
        return 'Shardbox';
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/shardbox/license/{shard}',
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
            '/shardbox/license/clear' => 'license',
        ];
    }
}
