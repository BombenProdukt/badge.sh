<?php

declare(strict_types=1);

namespace App\Badges\AUR;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/aur/license/{package}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package): array
    {
        return [
            'license' => $this->client->get($package)['License'],
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
                path: '/aur/license/google-chrome',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
