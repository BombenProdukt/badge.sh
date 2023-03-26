<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PeerBadge extends AbstractBadge
{
    protected array $routes = [
        '/david/peer/{repo:wildcard}/{path:wildcard?}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $repo, string $path): array
    {
        return $this->client->get($repo, $path, 'peer-');
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'peerDependencies',
            'message' => $this->statusInfo[$properties['status']][0],
            'messageColor' => $this->statusInfo[$properties['status']][1],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'peer dependencies',
                path: '/david/peer/epoberezkin/ajv-keywords',
                data: $this->render(['status' => 'uptodate']),
                deprecated: true,
            ),
        ];
    }
}
