<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MaintainabilityPercentageBadge extends AbstractBadge
{
    protected array $routes = [
        '/codeclimate/maintainability-percentage/{project:packageWithVendorOnly}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project): array
    {
        $response = $this->client->get($project, 'snapshots');

        return [
            'percentage' => $response['attributes']['ratings'][0]['measure']['value'],
            'letter' => $response['attributes']['ratings'][0]['letter'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('maintainability', $properties['percentage'], $properties['letter']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'maintainability (percentage)',
                path: '/codeclimate/maintainability-percentage/codeclimate/codeclimate',
                data: $this->render(['percentage' => 4.5, 'letter' => 'F']),
            ),
        ];
    }
}
