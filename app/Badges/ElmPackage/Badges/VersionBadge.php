<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/elm-package/version/{project}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project): array
    {
        return $this->client->get($project);
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
                path: '/elm-package/version/avh4/elm-color',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
