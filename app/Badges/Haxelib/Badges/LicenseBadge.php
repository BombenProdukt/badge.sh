<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/haxelib/license/{project}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $project): array
    {
        return [
            'license' => $this->client->get($project),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/haxelib/license/openfl',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
