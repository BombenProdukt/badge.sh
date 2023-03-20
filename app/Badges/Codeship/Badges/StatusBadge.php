<?php

declare(strict_types=1);

namespace App\Badges\Codeship\Badges;

use App\Badges\Codeship\Client;
use App\Badges\Templates\StatusTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId, ?string $branch = null): array
    {
        $response = $this->client->get($projectId, $branch);

        if (str_contains($response, 'id="project not found"')) {
            return StatusTemplate::make('build', 'project not found');
        }

        if (str_contains($response, 'id="passing"')) {
            return StatusTemplate::make('build', 'passing');
        }

        return StatusTemplate::make('build', 'failing');
    }

    public function service(): string
    {
        return 'CodeShip';
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
            '/codeship/status/{projectId}/{branch?}',
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
            '/codeship/status/0bdb0440-3af5-0133-00ea-0ebda3a33bf6' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
