<?php

declare(strict_types=1);

namespace App\Badges\Bitrise\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Bitrise\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $token, string $appId, ?string $branch = null): array
    {
        $status = $this->client->get($token, $appId, $branch)['status'];

        return $this->renderText('status', $status === 'unknown' ? 'branch not found' : $status, [
            'error'   => 'red.600',
            'success' => 'green.600',
            'unknown' => 'gray.600',
        ][$status]);
    }

    public function service(): string
    {
        return 'Bitrise';
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/bitrise/version/{token}/{appId}/{branch?}',
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
            '/bitrise/version/lESRN9rEFFfDq92JtXs_jw/3ff11fe8457bd304'        => 'version',
            '/bitrise/version/lESRN9rEFFfDq92JtXs_jw/3ff11fe8457bd304/master' => 'version',
        ];
    }
}
