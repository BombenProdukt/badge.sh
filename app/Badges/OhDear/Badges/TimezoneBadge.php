<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TimezoneBadge extends AbstractBadge
{
    protected string $route = '/ohdear/timezone/{domain}';

    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $domain): array
    {
        return [
            'domain' => $domain,
            'timezone' => $this->client->get($domain)['timezone'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['domain'],
            'message' => $properties['timezone'],
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'timezone',
                path: '/ohdear/timezone/status.laravel.com',
                data: $this->render(['domain' => 'status.laravel.com', 'timezone' => 'UTC']),
            ),
        ];
    }
}
