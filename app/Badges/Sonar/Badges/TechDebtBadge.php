<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class TechDebtBadge extends AbstractBadge
{
    protected string $route = '/sonar/{metric}/{component}/{branch}';

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
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/sqale_debt_ratio/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['ratio' => '0.1']),
            ),
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/tech_debt/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['ratio' => '0.1']),
            ),
        ];
    }
}
