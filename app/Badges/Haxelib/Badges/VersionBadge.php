<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/haxelib/version/{project}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project): array
    {
        return [
            'version' => $this->client->get($project),
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
                path: '/haxelib/version/tink_http',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/haxelib/version/nme',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
