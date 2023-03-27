<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class TestsBadge extends AbstractBadge
{
    protected string $route = '/sonar/{metric}/{component}/{branch}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $metric, string $component, string $branch): array
    {
        $metric = $metric === 'total_tests' ? 'tests' : $metric;

        return [
            'percentage' => $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch)[$metric],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('tests', $properties['percentage']);
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
            'skipped_tests',
            'test_errors',
            'test_execution_time',
            'test_failures',
            'test_success_density',
            'total_tests',
        ]);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/skipped_tests/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['percentage' => '100']),
            ),
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/test_errors/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['percentage' => '100']),
            ),
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/test_execution_time/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['percentage' => '100']),
            ),
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/test_failures/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['percentage' => '100']),
            ),
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/test_success_density/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['percentage' => '100']),
            ),
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/total_tests/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['percentage' => '100']),
            ),
        ];
    }
}
