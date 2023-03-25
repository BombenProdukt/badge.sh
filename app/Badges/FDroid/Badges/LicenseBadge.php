<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/f-droid/license/{appId}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $appId): array
    {
        return [
            'license' => $this->client->get($appId)['License'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
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
            '/f-droid/license/org.tasks' => 'license',
        ];
    }
}
