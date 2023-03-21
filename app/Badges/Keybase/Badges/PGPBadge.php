<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Keybase\Client;
use Illuminate\Routing\Route;

final class PGPBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $response = $this->client->get($username, 'public_keys');

        return [
            'label'        => 'PGP',
            'message'      => strtoupper(implode(' ', str_split(substr($response['them']['public_keys']['primary']['key_fingerprint'], -16), 4))),
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Keybase';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/keybase/pgp/{username}',
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
            '/keybase/pgp/lukechilds' => 'pgp key',
        ];
    }
}
