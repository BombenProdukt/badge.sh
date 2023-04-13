<?php

declare(strict_types=1);

namespace App\Badges\Netlify;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/netlify/status/{projectId}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $projectId): array
    {
        $status = $this->client->status($projectId);

        if (\str_contains($status, '#0F4A21')) {
            return [
                'status' => 'passing',
            ];
        }

        if (\str_contains($status, '#800A20')) {
            return [
                'status' => 'failing',
            ];
        }

        if (\str_contains($status, '#603408')) {
            return [
                'status' => 'building',
            ];
        }

        return [
            'status' => 'unknown',
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
                name: 'license',
                path: '/netlify/status/e6d5a4e0-dee1-4261-833e-2f47f509c68f',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
