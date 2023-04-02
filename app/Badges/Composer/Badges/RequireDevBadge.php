<?php

declare(strict_types=1);

namespace App\Badges\Composer\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RequireDevBadge extends AbstractBadge
{
    protected string $route = '/composer/require-dev/{service:bitbucket,github,gitlab}/{user}/{repo}/{package}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
        Category::VERSION,
    ];

    public function handle(string $service, string $user, string $repo, string $package): array
    {
        $response = $this->client->get($service, $user, $repo);

        return [
            'name' => $package,
            'version' => $response['require-dev'][$package],
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
                name: 'require-dev version',
                path: '/composer/require-dev/github/laravel/laravel/fakerphp/faker',
                data: $this->render(['name' => 'fakerphp/faker',  'version' => '^1.9.1']),
            ),
            new BadgePreviewData(
                name: 'require-dev version',
                path: '/composer/require-dev/github/laravel/laravel/laravel/pint',
                data: $this->render(['name' => 'laravel/pint',  'version' => '^1.0']),
            ),
            new BadgePreviewData(
                name: 'require-dev version',
                path: '/composer/require-dev/github/laravel/laravel/laravel/sail',
                data: $this->render(['name' => 'laravel/sail',  'version' => '^1.18']),
            ),
            new BadgePreviewData(
                name: 'require-dev version',
                path: '/composer/require-dev/github/laravel/laravel/mockery/mockery',
                data: $this->render(['name' => 'mockery/mockery',  'version' => '^1.4.4']),
            ),
            new BadgePreviewData(
                name: 'require-dev version',
                path: '/composer/require-dev/github/laravel/laravel/nunomaduro/collision',
                data: $this->render(['name' => 'nunomaduro/collision',  'version' => '^7.0']),
            ),
            new BadgePreviewData(
                name: 'require-dev version',
                path: '/composer/require-dev/github/laravel/laravel/phpunit/phpunit',
                data: $this->render(['name' => 'phpunit/phpunit',  'version' => '^10.0']),
            ),
            new BadgePreviewData(
                name: 'require-dev version',
                path: '/composer/require-dev/github/laravel/laravel/spatie/laravel-ignition',
                data: $this->render(['name' => 'spatie/laravel-ignition',  'version' => '^2.0']),
            ),
        ];
    }
}
