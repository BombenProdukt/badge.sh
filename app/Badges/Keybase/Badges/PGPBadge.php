<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Enums\Category;

final class PGPBadge extends AbstractBadge
{
    protected array $routes = [
        '/keybase/pgp/{username}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

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

    public function previews(): array
    {
        return [
            '/keybase/pgp/lukechilds' => 'pgp key',
        ];
    }
}
