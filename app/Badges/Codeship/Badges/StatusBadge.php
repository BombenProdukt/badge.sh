<?php

declare(strict_types=1);

namespace App\Badges\Codeship\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Codeship\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId, ?string $branch = null): array
    {
        $response = $this->client->get($projectId, $branch);

        if (str_contains($response, 'id="project not found"')) {
            return $this->renderStatus('build', 'project not found');
        }

        if (str_contains($response, 'id="passing"')) {
            return $this->renderStatus('build', 'passing');
        }

        return $this->renderStatus('build', 'failing');
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
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/codeship/status/{projectId}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/codeship/status/0bdb0440-3af5-0133-00ea-0ebda3a33bf6' => 'status',
        ];
    }
}
