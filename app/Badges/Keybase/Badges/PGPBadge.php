<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PGPBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        $response = $this->client->get($username, 'public_keys');

        return [
            'key' => \mb_strtoupper(\implode(' ', \mb_str_split(\mb_substr($response['them']['public_keys']['primary']['key_fingerprint'], -16), 4))),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'PGP',
            'message' => $properties['key'],
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
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
