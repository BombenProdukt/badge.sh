<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UserModuleCount extends AbstractBadge
{
    protected string $route = '/puppetforge/user-module-count/{user}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user): array
    {
        return [
            'count' => $this->client->user($user)['module_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('module count', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/puppetforge/user-module-count/camptocamp',
                data: $this->render(['count' => '1']),
            ),
        ];
    }
}
