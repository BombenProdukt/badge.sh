<?php

declare(strict_types=1);

namespace App\Badges\OPAM;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/opam/version/{name}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $name): array
    {
        \preg_match('/class="package-version">([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'version' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/opam/version/merlin',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/opam/version/ocamlformat',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
