<?php

declare(strict_types=1);

namespace App\Badges\DavidDM;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class OptionalBadge extends AbstractBadge
{
    protected string $route = '/david/optional/{repo:wildcard}/{path:wildcard?}';

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $repo, string $path): array
    {
        return $this->client->get($repo, $path, 'optional-');
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'optionalDependencies',
            'message' => $this->statusInfo[$properties['status']][0],
            'messageColor' => $this->statusInfo[$properties['status']][1],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'optional dependencies',
                path: '/david/optional/epoberezkin/ajv-keywords',
                data: $this->render(['status' => 'uptodate']),
                deprecated: true,
            ),
        ];
    }
}
