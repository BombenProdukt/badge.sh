<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $distribution): array
    {
        return [
            'version' => $this->normalizeVersion($this->client->get("release/{$distribution}")['version']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/cpan/version/{distribution}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cpan/version/App::cpanminus' => 'version',
        ];
    }

    private function normalizeVersion(string $version): string
    {
        $version = str_replace('_', '', $version);
        if (! $version || str_starts_with($version, 'v')) {
            return $version;
        }
        [$major, $rest] = explode('.', $version, 2);
        $minor          = substr($rest, 0, 3);
        $patch          = str_pad(substr($rest, 3), 3, '0', STR_PAD_RIGHT);

        return implode('.', array_map('intval', [$major, $minor, $patch]));
    }
}
