<?php

declare(strict_types=1);

namespace App\Badges\Node\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/node/version/{package:wildcard}/{tag?}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package, ?string $tag = 'latest'): array
    {
        return [
            'package' => $package,
            'tag' => $tag,
            'version' => Arr::get($this->client->get($package, $tag, $this->getRequestData('registry')), 'engines.node'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion(
            $properties['tag'] === 'latest' ? $properties['package'] : $properties['package'].'@'.$properties['tag'],
            $properties['version'],
        );
    }

    public function routeRules(): array
    {
        return [
            'registry' => ['nullable', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'node version',
                path: '/node/version/passport',
                data: $this->render(['package' => 'passport', 'tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'node version (tag)',
                path: '/node/version/passport/latest',
                data: $this->render(['package' => 'passport', 'tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'node version (tag, custom registry)',
                path: '/node/version/passport/latest?registry=https://registry.npmjs.com',
                data: $this->render(['package' => 'passport', 'tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'node version (scoped)',
                path: '/node/version/@stdlib/stdlib',
                data: $this->render(['package' => 'passport', 'tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'node version (scoped, tag)',
                path: '/node/version/@stdlib/stdlib/latest',
                data: $this->render(['package' => 'passport', 'tag' => 'latest', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'node version (scoped, tag, custom registry)',
                path: '/node/version/@stdlib/stdlib/latest?registry=https://registry.npmjs.com',
                data: $this->render(['package' => 'passport', 'tag' => 'latest', 'version' => '1.0.0']),
            ),
        ];
    }
}
