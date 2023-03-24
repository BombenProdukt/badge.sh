<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TestedVersionsBadge extends AbstractBadge
{
    public function handle(string $resourceId): array
    {
        $testedVersions = $this->client->resource($resourceId)['testedVersions'];
        $earliest       = $testedVersions[0];
        $latest         = end($testedVersions);

        if ($earliest === $latest) {
            return $this->renderVersion($earliest);
        }

        return $this->renderVersion("{$earliest}-{$latest}", 'tested versions');
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/spiget/tested-versions/{resourceId}',
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
            '/spiget/tested-versions/9089' => 'tested versions',
        ];
    }
}
