<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CoverageGradeBadge extends AbstractBadge
{
    protected string $route = '/codeclimate/coverage-grade/{user}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $user, string $repo): array
    {
        return [
            'letter' => $this->client->get($user, $repo, 'test_reports')['attributes']['rating']['letter'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('coverage', $properties['letter']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage (letter)',
                path: '/codeclimate/coverage-grade/codeclimate/codeclimate',
                data: $this->render(['letter' => 'C']),
            ),
        ];
    }
}
