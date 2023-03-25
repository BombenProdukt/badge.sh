<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TechDebtBadge extends AbstractBadge
{
    protected array $routes = [
        '/sonar/{metric}/{component}/{branch}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

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

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
            'sonarVersion' => ['required', 'numeric'],
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('metric', [
            'sqale_debt_ratio',
            'tech_debt',
        ]);
    }

    public function previews(): array
    {
        return [
            '/sonar/sqale_debt_ratio/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
            '/sonar/tech_debt/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
        ];
    }
}
