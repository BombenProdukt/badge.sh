<?php

declare(strict_types=1);

namespace App\Badges\OSSLifecycle\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Spatie\Regex\Regex;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/oss-lifecycle/status/{user}/{repo}/{branch?}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $user, string $repo, ?string $branch = null): array
    {
        return [
            'status' => Regex::match('/osslifecycle=(.*)/', $this->client->get($user, $repo, $branch))->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('status', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/oss-lifecycle/status/Netflix/osstracker',
                data: $this->render(['status' => 'success']),
            ),
            new BadgePreviewData(
                name: 'status with branch',
                path: '/oss-lifecycle/status/Netflix/osstracker/documentation',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
