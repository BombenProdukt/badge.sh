<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Badges\AbstractBadge;
use App\Badges\JSDelivr\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class HitsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $platform, string $package): array
    {
        $total = $this->client->data($platform, $package)['total'];

        return [
            'label'        => 'jsDelivr',
            'message'      => FormatNumber::execute($total).'/month',
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'jsDelivr';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/jsdelivr/hits/{platform}/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jsdelivr/hits/gh/jquery/jquery' => 'hits (per month)',
            '/jsdelivr/hits/npm/lodash'       => 'hits (per month)',
        ];
    }
}
