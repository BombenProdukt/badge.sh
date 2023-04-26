<?php

declare(strict_types=1);

namespace App\Badges\HTTPS;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RequestBadge extends AbstractBadge
{
    protected string $route = '/https/{host}/{path:wildcard?}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'https endpoint',
                path: '/https/cal-badge-icd0onfvrxx6.runkit.sh',
                data: $this->render(['label' => 'Time', 'message' => 'Asia/Shanghai', 'messageColor' => 'blue.600']),
            ),
            new BadgePreviewData(
                name: 'https endpoint (with path args)',
                path: '/https/cal-badge-icd0onfvrxx6.runkit.sh/Asia/Shanghai',
                data: $this->render(['label' => 'Time', 'message' => 'Asia/Shanghai', 'messageColor' => 'blue.600']),
            ),
            new BadgePreviewData(
                name: 'https endpoint (with path args)',
                path: '/https/cal-badge-icd0onfvrxx6.runkit.sh/America/Los_Angeles',
                data: $this->render(['label' => 'Time', 'message' => 'America/Los_Angeles', 'messageColor' => 'blue.600']),
            ),
        ];
    }
}
