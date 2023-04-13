<?php

declare(strict_types=1);

namespace App\Badges\Composer;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RequireBadge extends AbstractBadge
{
    protected string $route = '/composer/require/{service:bitbucket,github,gitlab}/{user}/{repo}/{package:wildcard}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
        Category::VERSION,
    ];

    public function handle(string $service, string $user, string $repo, string $package): array
    {
        $response = $this->client->get($service, $user, $repo);

        return [
            'name' => $package,
            'version' => $response['require'][$package],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText($properties['name'], $properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'require version',
                path: '/composer/require/github/laravel/laravel/guzzlehttp/guzzle',
                data: $this->render(['name' => 'guzzlehttp/guzzle', 'version' => '^7.2']),
            ),
            new BadgePreviewData(
                name: 'require version',
                path: '/composer/require/github/laravel/laravel/laravel/framework',
                data: $this->render(['name' => 'laravel/framework', 'version' => '^10.0']),
            ),
            new BadgePreviewData(
                name: 'require version',
                path: '/composer/require/github/laravel/laravel/laravel/sanctum',
                data: $this->render(['name' => 'laravel/sanctum', 'version' => '^3.2']),
            ),
            new BadgePreviewData(
                name: 'require version',
                path: '/composer/require/github/laravel/laravel/laravel/tinker',
                data: $this->render(['name' => 'laravel/tinker', 'version' => '^2.8']),
            ),
        ];
    }
}
