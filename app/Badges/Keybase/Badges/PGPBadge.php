<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PGPBadge extends AbstractBadge
{
    protected string $route = '/keybase/pgp/{username}';

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
            new BadgePreviewData(
                name: 'pgp key',
                path: '/keybase/pgp/lukechilds',
                data: $this->render(['key' => 'A1B2 C3D4 E5F6 G7H8']),
            ),
        ];
    }
}
