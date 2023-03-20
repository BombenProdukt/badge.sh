<?php

declare(strict_types=1);

namespace App\Badges\Bitrise\Badges;

use App\Badges\Bitrise\Client;
use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $token, string $appId, ?string $branch = null): array
    {
        $status = $this->client->get($token, $appId, $branch)['status'];

        return TextTemplate::make('status', $status === 'unknown' ? 'branch not found' : $status, [
            'error'   => 'red.600',
            'success' => 'green.600',
            'unknown' => 'gray.600',
        ][$status]);
    }

    public function service(): string
    {
        return 'Bitrise';
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
            '/bitrise/{token}/{appId}/version/{branch?}',
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
            '/bitrise/lESRN9rEFFfDq92JtXs_jw/3ff11fe8457bd304/version'        => 'version',
            '/bitrise/lESRN9rEFFfDq92JtXs_jw/3ff11fe8457bd304/version/master' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
