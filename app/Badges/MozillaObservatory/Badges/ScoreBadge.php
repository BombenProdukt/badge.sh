<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory\Badges;

use App\Badges\AbstractBadge;
use App\Badges\MozillaObservatory\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ScoreBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $host): array
    {
        return $this->renderText('observatory', $this->client->get($host)['score'].'/100', 'blue.600');
    }

    public function service(): string
    {
        return 'Mozilla Observatory';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/mozilla-observatory/score/{host}',
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
            '/mozilla-observatory/score/github.com' => 'score',
        ];
    }
}
