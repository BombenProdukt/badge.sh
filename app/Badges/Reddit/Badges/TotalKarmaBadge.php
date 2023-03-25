<?php

declare(strict_types=1);

namespace App\Badges\Reddit\Badges;

use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class TotalKarmaBadge extends AbstractBadge
{
    protected array $routes = [
        '/reddit/karma/{user}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $user): array
    {
        return [
            'username' => $user,
            'karma' => $this->client->get("user/{$user}/about.json")['total_karma'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'u/'.$properties['username'],
            'message' => FormatNumber::execute($properties['karma']).' karma',
            'messageColor' => 'ff4500',
        ];
    }

    public function previews(): array
    {
        return [
            '/reddit/karma/spez' => 'karma',
        ];
    }
}
