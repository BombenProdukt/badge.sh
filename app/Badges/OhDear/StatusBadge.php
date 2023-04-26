<?php

declare(strict_types=1);

namespace App\Badges\OhDear;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/ohdear/status/{domain}/{label}';

    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $domain, string $label): array
    {
        return [
            'label' => $label,
            'status' => collect($this->client->get($domain)['sites'])->flatten(1)->firstWhere('label', $label)['status'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'],
            'message' => $properties['status'],
            'messageColor' => $properties['status'] === 'up' ? 'green.600' : 'red.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/ohdear/status/status.laravel.com/forge.laravel.com',
                data: $this->render(['label' => 'forge.laravel.com', 'status' => 'up']),
            ),
        ];
    }
}
