<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Enums\Category;

final class TimezoneBadge extends AbstractBadge
{
    protected array $routes = [
        '/ohdear/timezone/{domain}',
    ];

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
            '/ohdear/timezone/status.laravel.com' => 'timezone',
        ];
    }
}
