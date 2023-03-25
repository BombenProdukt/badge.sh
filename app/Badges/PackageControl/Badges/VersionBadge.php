<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/f-droid/{appId}/version',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $appId): array
    {
        return $this->client->get($appId)['versions'][0];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/f-droid/org.schabi.newpipe/version' => 'version',
            '/f-droid/com.amaze.filemanager/version' => 'version',
        ];
    }
}
