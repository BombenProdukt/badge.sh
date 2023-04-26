<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MaintainabilityPercentageBadge extends AbstractBadge
{
    protected string $route = '/codeclimate/maintainability-percentage/{user}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $user, string $repo): array
    {
        $response = $this->client->get($user, $repo, 'snapshots');

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
