<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UserReleaseCount extends AbstractBadge
{
    protected string $route = '/puppetforge/user-release-count/{user}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user): array
    {
        return [
            'count' => $this->client->user($user)['release_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('release count', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/puppetforge/user-release-count/camptocamp',
                data: $this->render(['count' => '1']),
            ),
        ];
    }
}
