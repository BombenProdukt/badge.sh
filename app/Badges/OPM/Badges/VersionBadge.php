<?php

declare(strict_types=1);

namespace App\Badges\OPM\Badges;

use App\Enums\Category;
use Spatie\Regex\Regex;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/opm/version/{user}/{moduleName}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user, string $moduleName): array
    {
        return [
            'version' => Regex::match("/{$moduleName}-(.+).opm/", $this->client->version($user, $moduleName))->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/opm/version/openresty/lua-resty-lrucache' => 'version',
        ];
    }
}
