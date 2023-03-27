<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DocumentApiDensityBadge extends AbstractBadge
{
    protected string $route = '/sonar/public_documented_api_density/{component}/{branch}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $metric, string $component, string $branch): array
    {
        return [
            'percentage' => $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch)['public_documented_api_density'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('public documented api density', $properties['percentage']);
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
                path: '/sonar/public_documented_api_density/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['percentage' => '0.0']),
            ),
        ];
    }
}
