<?php

declare(strict_types=1);

namespace App\Badges\HexPM;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/hex/l/{packageName}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return $this->client->get($packageName)['meta'];
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
                path: '/hex/l/plug',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
