<?php

declare(strict_types=1);

namespace App\Badges\DeepScan;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GradeBadge extends AbstractBadge
{
    protected string $route = '/deepscan/grade/team/{teamId}/project/{projectId}/branch/{branchId}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $teamId, string $projectId, string $branchId): array
    {
        return $this->client->get($teamId, $projectId, $branchId);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'deepscan',
            'message' => \mb_strtolower($properties['grade']),
            'messageColor' => [
                'none' => 'cecece',
                'good' => '89b414',
                'normal' => '2148b1',
                'poor' => 'ff5a00',
            ][\mb_strtolower($properties['grade'])],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'grade',
                path: '/deepscan/grade/team/7382/project/9494/branch/123838',
                data: $this->render(['grade' => 'none']),
            ),
            new BadgePreviewData(
                name: 'grade',
                path: '/deepscan/grade/team/279/project/1302/branch/3514',
                data: $this->render(['grade' => 'good']),
            ),
            new BadgePreviewData(
                name: 'grade',
                path: '/deepscan/grade/team/8527/project/10741/branch/152550',
                data: $this->render(['grade' => 'normal']),
            ),
            new BadgePreviewData(
                name: 'grade',
                path: '/deepscan/grade/team/8527/project/10741/branch/152550',
                data: $this->render(['grade' => 'poor']),
            ),
        ];
    }
}
