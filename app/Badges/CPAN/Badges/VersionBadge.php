<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/cpan/version/{distribution}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

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
        $version = \str_replace('_', '', $version);

        if (!$version || \str_starts_with($version, 'v')) {
            return $version;
        }
        [$major, $rest] = \explode('.', $version, 2);
        $minor = \mb_substr($rest, 0, 3);
        $patch = \str_pad(\mb_substr($rest, 3), 3, '0', \STR_PAD_RIGHT);

        return \implode('.', \array_map('intval', [$major, $minor, $patch]));
    }
}
