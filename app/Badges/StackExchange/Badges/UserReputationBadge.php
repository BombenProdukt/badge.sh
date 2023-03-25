<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UserReputationBadge extends AbstractBadge
{
    protected array $routes = [
        '/stack-exchange/user/reputation/{site}/{query}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $site, string $query): array
    {
        return $this->client->user($site, $query);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('reputation', $properties['reputation']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'reputation',
                path: '/stack-exchange/user/reputation/stackoverflow/123',
                data: $this->render([]),
            ),
        ];
    }
}
