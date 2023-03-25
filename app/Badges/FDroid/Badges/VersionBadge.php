<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

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
        return [
            'version' => $this->client->get($appId)['CurrentVersion'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/f-droid/org.schabi.newpipe/version' => 'version',
            '/f-droid/com.amaze.filemanager/version' => 'version',
        ];
    }
}
