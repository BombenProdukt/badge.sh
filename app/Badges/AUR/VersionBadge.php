<?php

declare(strict_types=1);

namespace App\Badges\AUR;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/aur/version/{package}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return [
            'version' => $this->client->get($package)['Version'],
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
                path: '/aur/version/google-chrome',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
