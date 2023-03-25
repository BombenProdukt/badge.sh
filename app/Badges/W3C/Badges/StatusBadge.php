<?php

declare(strict_types=1);

namespace App\Badges\W3C\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/w3c/status',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(): array
    {
        return [
            'count' => collect($this->client->get($this->getRequestData('url'))['messages'])
                ->filter(fn ($message) => \in_array($message['type'], ['error', 'warning'], true))
                ->count(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('w3c', $properties['count'] > 0 ? 'failed' : 'passed');
    }

    public function routeRules(): array
    {
        return [
            'url' => ['required', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/w3c/status?url=https://youtube.com/',
                data: $this->render([]),
            ),
        ];
    }
}
