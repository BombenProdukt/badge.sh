<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PassedCountBadge extends AbstractBadge
{
    public function handle(string $org, string $project, string $space): array
    {
        return $this->client->get($org, $project, $space);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('passed', $properties['passed'], 'green.600');
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/testspace/passed-count/{org}/{project}/{space}',
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
            '/testspace/passed-count/swellaby/swellaby:testspace-sample/main' => 'passed tests count',
        ];
    }
}
