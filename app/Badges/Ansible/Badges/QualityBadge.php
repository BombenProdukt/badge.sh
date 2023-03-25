<?php

declare(strict_types=1);

namespace App\Badges\Ansible\Badges;

use App\Enums\Category;

final class QualityBadge extends AbstractBadge
{
    protected array $routes = [
        '/ansible/quality/{projectId}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectId): array
    {
        return [
            'score' => $this->client->content($projectId)['quality_score'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('quality', $properties['score']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/ansible/quality/432' => '',
        ];
    }
}
