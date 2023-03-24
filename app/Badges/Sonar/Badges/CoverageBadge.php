<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Enums\Category;

final class CoverageBadge extends AbstractBadge
{
    public function handle(string $metric, string $component, string $branch): array
    {
        return [
            'percentage' => $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch)['coverage'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage']);
    }

    public function keywords(): array
    {
        return [Category::COVERAGE];
    }

    public function routePaths(): array
    {
        return [
            '/sonar/coverage/{component}/{branch}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'instance'     => ['required', 'url'],
            'sonarVersion' => ['required', 'numeric'],
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sonar/coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
        ];
    }
}
