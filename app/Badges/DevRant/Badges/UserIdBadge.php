<?php

declare(strict_types=1);

namespace App\Badges\DevRant\Badges;

use App\Badges\AbstractBadge;
use App\Badges\DevRant\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class UserIdBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $userId): array
    {
        $profile = $this->client->get($userId);

        return [
            'label'        => ucfirst($profile['username']),
            'message'      => FormatNumber::execute($profile['score']),
            'messageColor' => 'f99a66',
        ];
    }

    public function service(): string
    {
        return 'devRant';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/devrant/score/{userId}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereNumber('userId');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/devrant/score/22941' => 'score',
        ];
    }
}
