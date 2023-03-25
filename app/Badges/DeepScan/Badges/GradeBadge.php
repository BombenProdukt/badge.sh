<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class GradeBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/deepscan/grade/team/{teamId}/project/{projectId}/branch/{branchId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/deepscan/grade/team/7382/project/9494/branch/123838' => 'grade',
            '/deepscan/grade/team/279/project/1302/branch/3514' => 'grade',
            '/deepscan/grade/team/8527/project/10741/branch/152550' => 'grade',
        ];
    }
}
