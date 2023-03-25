<?php

declare(strict_types=1);

namespace App\Badges\Discourse\Badges;

use App\Enums\Category;

final class TopicsBadge extends AbstractBadge
{
    protected array $routes = [
        '/discourse/topics/{server}',
    ];

    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $server): array
    {
        return [
            'count' => $this->client->statistics($server)['topic_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('topics', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/discourse/topics/meta.discourse.org' => 'topics',
        ];
    }
}
