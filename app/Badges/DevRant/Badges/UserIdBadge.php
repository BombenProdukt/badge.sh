<?php

declare(strict_types=1);

namespace App\Badges\DevRant\Badges;

use App\Actions\FormatNumber;
use App\Badges\DevRant\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class UserIdBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $userId): array
    {
        $profile = $this->client->get($userId);

        return [
            'label'       => ucfirst($profile['username']),
            'status'      => FormatNumber::execute($profile['score']),
            'statusColor' => 'f99a66',
        ];
    }

    public function service(): string
    {
        return 'devRant';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/devrant/score/{userId}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereNumber('userId');
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/devrant/score/22941' => 'score',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
