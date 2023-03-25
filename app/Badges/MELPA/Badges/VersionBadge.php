<?php

declare(strict_types=1);

namespace App\Badges\MELPA\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/melpa/version/{package}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        \preg_match('/<title>([^<]+)<\//i', $this->client->get($package), $matches);

        return [
            'version' => \explode(':', \trim($matches[1]))[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/melpa/version/magit' => 'version',
        ];
    }
}
