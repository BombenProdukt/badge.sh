<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CoverageBadge extends AbstractBadge
{
    protected string $route = '/codeclimate/coverage/{user}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $user, string $repo): array
    {
        return [
            'percentage' => $this->client->get($user, $repo, 'test_reports')['attributes']['rating']['measure']['value'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage',
                path: '/codeclimate/coverage/codeclimate/codeclimate',
                data: $this->render(['percentage' => '66.66']),
            ),
        ];
    }
}
