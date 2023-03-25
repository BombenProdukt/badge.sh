<?php

declare(strict_types=1);

namespace App\Badges\DocsRS\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/docsrs/version/{crate}/{version?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $crate, ?string $version = 'latest'): array
    {
        if ($this->client->status($crate, $version)) {
            return [
                'status' => 'passing',
                'version' => $version,
            ];
        }

        return [
            'status' => 'failing',
            'version' => $version,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('docs@'.$properties['version'], $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/docsrs/version/regex',
                data: $this->render([]),
            ),
        ];
    }
}
