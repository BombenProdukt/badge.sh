<?php

declare(strict_types=1);

namespace App\Badges\Codacy;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GradeBadge extends AbstractBadge
{
    protected string $route = '/codacy/grade/{projectId}/{branch?}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectId, ?string $branch = null): array
    {
        \preg_match('/visibility=[^>]*?>([^<]+)<\//i', $this->client->get('grade', $projectId, $branch), $matches);

        return [
            'grade' => \trim($matches[1]),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('code quality', $properties['grade']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'code quality',
                path: '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e',
                data: $this->render(['grade' => 'C']),
            ),
            new BadgePreviewData(
                name: 'branch code quality',
                path: '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e/master',
                data: $this->render(['grade' => 'C']),
            ),
        ];
    }
}
