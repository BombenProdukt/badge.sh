<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Arr;

final class PhpVersionBadge extends AbstractBadge
{
    protected string $route = '/packagist/php-version/{vendor}/{project}/{channel?}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $vendor, string $project, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($vendor, $project);

        $pkg = Arr::get($packageMeta['versions'], $this->getVersion($packageMeta, $channel));

        return [
            'version' => Arr::get($pkg, 'require.php', '*'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('php', $properties['version']);
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
