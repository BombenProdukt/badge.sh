<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TechDebtBadge extends AbstractBadge
{
    public function handle(string $metric, string $component, string $branch): array
    {
        $response = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch);

        return [
            'ratio' => $response['sqale_debt_ratio'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('tech debt', $properties['ratio']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/sonar/{metric}/{component}/{branch}',
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

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('metric', [
            'sqale_debt_ratio',
            'tech_debt',
        ]);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sonar/sqale_debt_ratio/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
            '/sonar/tech_debt/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'        => 'complexity',
        ];
    }
}
