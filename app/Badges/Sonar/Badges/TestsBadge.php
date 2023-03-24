<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Sonar\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class TestsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $metric, string $component, string $branch): array
    {
        $metric   = $metric === 'total_tests' ? 'tests' : $metric;
        $response = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch)[$metric];

        return $this->renderPercentage('tests', $response);
    }

    public function service(): string
    {
        return 'Sonar';
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
            'skipped_tests',
            'test_errors',
            'test_execution_time',
            'test_failures',
            'test_success_density',
            'total_tests',
        ]);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sonar/skipped_tests/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'        => 'complexity',
            '/sonar/test_errors/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'          => 'complexity',
            '/sonar/test_execution_time/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'  => 'complexity',
            '/sonar/test_failures/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'        => 'complexity',
            '/sonar/test_success_density/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
            '/sonar/total_tests/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'          => 'complexity',
        ];
    }
}
