<?php

declare(strict_types=1);

namespace App\Badges\OpenSuseBuildService\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-suse-build-service/status/{project}/{packageName}/{repository}/{arch}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $project, string $packageName, string $repository, string $arch): array
    {
        return [
            'status' => $this->client->get($project, $packageName, $repository, $arch),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build status', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'build status',
                path: '/open-suse-build-service/status/openSUSE:Tools/osc/Debian_111/x86_64',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
