<?php

declare(strict_types=1);

namespace App\Badges\DevRant\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class UserIdBadge extends AbstractBadge
{
    protected array $routes = [
        '/devrant/score/{userId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $userId): array
    {
        return $this->client->get($userId);
    }

    public function render(array $properties): array
    {
        return [
            'label' => \ucfirst($properties['username']),
            'message' => FormatNumber::execute($properties['score']),
            'messageColor' => 'f99a66',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereNumber('userId');
    }

    public function previews(): array
    {
        return [
            '/devrant/score/22941' => 'score',
        ];
    }
}
