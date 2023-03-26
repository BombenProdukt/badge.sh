<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MaintainabilityBadge extends AbstractBadge
{
    protected array $routes = [
        '/codeclimate/maintainability/{project:packageWithVendorOnly}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project): array
    {
        return $this->client->get($project, 'snapshots')['attributes']['ratings'][0];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('maintainability', $properties['letter']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'maintainability',
                path: '/codeclimate/maintainability/codeclimate/codeclimate',
                data: $this->render(['letter' => 'A']),
            ),
        ];
    }
}
