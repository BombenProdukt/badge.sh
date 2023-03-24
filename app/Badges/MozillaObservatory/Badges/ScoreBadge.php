<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ScoreBadge extends AbstractBadge
{
    public function handle(string $host): array
    {
        return $this->client->get($host);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('observatory', $properties['score']);
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
