<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UntestedCountBadge extends AbstractBadge
{
    public function handle(string $org, string $project, string $space): array
    {
        return $this->client->get($org, $project, $space);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('untested', $properties['untested'], 'orange.600');
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/testspace/untested-count/{org}/{project}/{space}',
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
            '/testspace/untested-count/swellaby/swellaby:testspace-sample/main' => 'untested tests count',
        ];
    }
}
