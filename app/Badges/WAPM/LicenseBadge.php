<?php

declare(strict_types=1);

namespace App\Badges\WAPM;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/wapm/license/{package:wildcard}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package): array
    {
        return $this->client->get($package);
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
                path: '/wapm/license/huhn/hello-wasm',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
