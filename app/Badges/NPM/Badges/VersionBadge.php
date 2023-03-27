<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/npm/version/{package:packageWithScope}/{tag?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'package' => $package,
            'tag' => $tag,
            'version' => $this->client->unpkg("{$package}@{$tag}/package.json")['version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion(
            $properties['tag'] === 'latest' ? 'npm' : 'npm@'.$properties['tag'],
            $properties['version'],
        );
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/npm/version/express',
                data: $this->render(['tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/npm/version/yarn',
                data: $this->render(['tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (tag)',
                path: '/npm/version/yarn/berry',
                data: $this->render(['tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (tag)',
                path: '/npm/version/yarn/legacy',
                data: $this->render(['tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (scoped package)',
                path: '/npm/version/@babel/core',
                data: $this->render(['tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (scoped & tag)',
                path: '/npm/version/@nestjs/core/beta',
                data: $this->render(['tag' => 'latest', 'version' => '1.0.0']),
            ),
        ];
    }
}
