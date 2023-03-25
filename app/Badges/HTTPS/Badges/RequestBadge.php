<?php

declare(strict_types=1);

namespace App\Badges\HTTPS\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RequestBadge extends AbstractBadge
{
    protected array $routes = [
        '/https/{host}/{path?}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $host, ?string $path = null): array
    {
        return $this->client->get($host, $path);
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'],
            'message' => $properties['message'],
            'messageColor' => $properties['messageColor'],
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'https endpoint',
                path: '/https/cal-badge-icd0onfvrxx6.runkit.sh',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'https endpoint (with path args)',
                path: '/https/cal-badge-icd0onfvrxx6.runkit.sh/Asia/Shanghai',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'https endpoint (with path args)',
                path: '/https/cal-badge-icd0onfvrxx6.runkit.sh/America/Los_Angeles',
                data: $this->render([]),
            ),
        ];
    }
}
