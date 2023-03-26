<?php

declare(strict_types=1);

namespace App\Badges\Composer\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PhpVersion extends AbstractBadge
{
    protected array $routes = [
        '/composer/php-version/{service}/{user}/{repo}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
        Category::VERSION,
    ];

    public function handle(string $service, string $user, string $repo): array
    {
        $response = $this->client->github($user, $repo);

        return [
            'name' => $response['name'],
            'version' => $response['require']['php'],
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
                name: 'php version',
                path: '/composer/php-version/github/laravel/laravel',
                data: $this->render(['version' => '^8.1']),
            ),
        ];
    }
}
