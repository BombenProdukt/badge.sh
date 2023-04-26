<?php

declare(strict_types=1);

namespace App\Badges\Ansible;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class QualityBadge extends AbstractBadge
{
    protected string $route = '/ansible/quality/{projectId}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'quality',
                path: '/ansible/quality/432',
                data: $this->render(['score' => 0]),
            ),
        ];
    }
}
