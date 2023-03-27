<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\Packagist\Concerns\HandlesVersions;
use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class PhpVersionBadge extends AbstractBadge
{
    use HandlesVersions;

    protected string $route = '/packagist/php-version/{package:packageWithVendorOnly}/{channel?}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        $pkg = Arr::get($packageMeta['versions'], $this->getVersion($packageMeta, $channel));

        return [
            'version' => Arr::get($pkg, 'require.php', '*'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'php');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'php',
                path: '/packagist/php-version/monolog/monolog',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
