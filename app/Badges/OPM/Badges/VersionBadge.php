<?php

declare(strict_types=1);

namespace App\Badges\OPM\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/opm/version/openresty/lua-resty-lrucache',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
