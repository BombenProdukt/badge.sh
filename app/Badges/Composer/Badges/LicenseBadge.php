<?php

declare(strict_types=1);

namespace App\Badges\Composer\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/composer/license/{service:bitbucket,github,gitlab}/{user}/{repo}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $service, string $user, string $repo): array
    {
        $response = $this->client->get($service, $user, $repo);

        return [
            'name' => $response['name'],
            'license' => $response['license'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/composer/license/github/laravel/laravel',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
