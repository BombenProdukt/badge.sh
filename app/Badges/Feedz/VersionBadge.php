<?php

declare(strict_types=1);

namespace App\Badges\Feedz;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/feedz/version/{organization}/{repository}/{packageName}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $organization, string $repository, string $packageName): array
    {
        return [
            'version' => head($this->client->items($organization, $repository, $packageName)),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/feedz/version/shieldstests/mongodb/MongoDB.Driver.Core',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
