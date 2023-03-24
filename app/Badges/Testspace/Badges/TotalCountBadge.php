<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TotalCountBadge extends AbstractBadge
{
    public function handle(string $org, string $project, string $space): array
    {
        return [
            'downloads' => $this->client->get($org, $project, $space)['total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('total', $properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/testspace/total-count/{org}/{project}/{space}',
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
            '/testspace/total-count/swellaby/swellaby:testspace-sample/main' => 'total tests count',
        ];
    }
}
