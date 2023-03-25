<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CoverageBadge extends AbstractBadge
{
    protected array $routes = [
        '/sonar/coverage/{component}/{branch}',
    ];

    protected array $keywords = [
        Category::COVERAGE,
    ];

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

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
            'sonarVersion' => ['required', 'numeric'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render([]),
            ),
        ];
    }
}
