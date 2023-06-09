<?php

declare(strict_types=1);

namespace App\Badges\LuaRocks;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Composer\Semver\Comparator;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/luarocks/version/{user}/{moduleName}/{version?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user, string $moduleName, ?string $version = null): array
    {
        return [
            'version' => $this->latestVersion($this->client->get($user, $moduleName)),
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
                path: '/luarocks/version/mpeterv/luacheck',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }

    private function latestVersion(array $versions): ?string
    {
        return collect($versions)
            ->keys()
            ->map(fn ($version) => \str_starts_with($version, 'v') ? \mb_substr($version, 1) : $version)
            ->sort(fn ($a, $b) => Comparator::greaterThan($this->parseVersion($b), $this->parseVersion($a)))
            ->first();
    }

    private function parseVersion(string $versionString): string
    {
        return \explode('-', $versionString)[0];
    }
}
