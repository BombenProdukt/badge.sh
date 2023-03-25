<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight\Badges;

use App\Enums\Category;

final class GradeBadge extends AbstractBadge
{
    protected array $routes = [
        '/symfony-insight/grade/{projectUuid}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectUuid): array
    {
        return $this->client->get($projectUuid);
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('grade', $properties['grade']);
    }

    public function previews(): array
    {
        return [
            '/symfony-insight/grade/825be328-29f8-44f7-a750-f82818ae9111' => 'grade',
        ];
    }
}
