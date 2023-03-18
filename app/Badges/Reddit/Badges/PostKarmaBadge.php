<?php

declare(strict_types=1);

namespace App\Badges\Reddit\Badges;

use App\Actions\FormatNumber;
use App\Badges\Reddit\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class PostKarmaBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user): array
    {
        return [
            'label'       => "u/{$user}",
            'status'      => FormatNumber::execute($this->client->get("user/{$user}/about.json")['link_karma']).' post karma',
            'statusColor' => 'ff4500',
        ];
    }

    public function service(): string
    {
        return 'Reddit';
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
            '/reddit/post-karma/{user}',
            '/reddit/post-karma/u/{user}',
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
        //
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
            '/reddit/post-karma/u/spez' => 'post karma',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
