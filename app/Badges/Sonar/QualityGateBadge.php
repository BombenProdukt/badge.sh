<?php

declare(strict_types=1);

namespace App\Badges\Sonar;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class QualityGateBadge extends AbstractBadge
{
    protected string $route = '/sonar/{metric}/{component}/{branch}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $metric, string $component, string $branch): array
    {
        $response = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch);

        if ($response['alert_status'] === 'OK') {
            return [
                'status' => 'passed',
            ];
        }

        return [
            'status' => 'failed',
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('quality gate', $properties['status']);
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
            'alert_status',
            'quality_gate',
        ]);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/alert_status/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['status' => 'passed']),
            ),
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/quality_gate/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['status' => 'failed']),
            ),
        ];
    }
}
