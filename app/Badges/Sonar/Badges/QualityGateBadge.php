<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class QualityGateBadge extends AbstractBadge
{
    public function handle(string $metric, string $component, string $branch): array
    {
        $response = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch);

        if ($response['alert_status'] === 'OK') {
            return $this->renderStatus('quality gate', 'passed');
        }

        return $this->renderStatus('quality gate', 'failed');
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
            'alert_status',
            'quality_gate',
        ]);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sonar/alert_status/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
            '/sonar/quality_gate/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
        ];
    }
}
