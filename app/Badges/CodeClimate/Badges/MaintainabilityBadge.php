<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MaintainabilityBadge extends AbstractBadge
{
    protected string $route = '/codeclimate/maintainability/{user}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $user, string $repo): array
    {
        return $this->client->get($user, $repo, 'snapshots')['attributes']['ratings'][0];
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
