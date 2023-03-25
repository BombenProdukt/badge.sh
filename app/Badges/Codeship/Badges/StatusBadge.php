<?php

declare(strict_types=1);

namespace App\Badges\Codeship\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/codeship/status/{projectId}/{branch?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectId, ?string $branch = null): array
    {
        $response = $this->client->get($projectId, $branch);

        if (\str_contains($response, 'id="project not found"')) {
            return [
                'status' => 'project not found',
            ];
        }

        if (\str_contains($response, 'id="passing"')) {
            return [
                'status' => 'passing',
            ];
        }

        return [
            'status' => 'failing',
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/codeship/status/0bdb0440-3af5-0133-00ea-0ebda3a33bf6',
                data: $this->render([]),
            ),
        ];
    }
}
