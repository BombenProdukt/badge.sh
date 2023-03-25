<?php

declare(strict_types=1);

namespace App\Badges\Bitrise\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/bitrise/version/{token}/{appId}/{branch?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $token, string $appId, ?string $branch = null): array
    {
        return $this->client->get($token, $appId, $branch);
    }

    public function render(array $properties): array
    {
        return $this->renderText('status', $properties['status'] === 'unknown' ? 'branch not found' : $properties['status'], [
            'error' => 'red.600',
            'success' => 'green.600',
            'unknown' => 'gray.600',
        ][$properties['status']]);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/bitrise/version/lESRN9rEFFfDq92JtXs_jw/3ff11fe8457bd304',
                data: $this->render(['status' => 'success']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/bitrise/version/lESRN9rEFFfDq92JtXs_jw/3ff11fe8457bd304/master',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
