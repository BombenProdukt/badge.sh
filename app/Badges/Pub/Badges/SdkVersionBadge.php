<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;

final class SdkVersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/pub/sdk-version/{package}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $package): array
    {
        return [
            'version' => $this->client->api("packages/{$package}")['latest']['pubspec']['environment']['sdk'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'dart sdk');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/pub/sdk-version/uuid' => 'sdk-version',
        ];
    }
}
