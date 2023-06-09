<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ElmVersionBadge extends AbstractBadge
{
    protected string $route = '/elm-package/elm-version/{project}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT, Category::VERSION,
    ];

    public function handle(string $project): array
    {
        $parts = \preg_split('/\s+/', $this->client->get($project)['elm-version']);
        $parts = \array_filter($parts, fn ($it) => $it !== 'v');

        if (\count($parts) === 1) {
            return $parts[0];
        }

        [$lower, $lowerOp, $upperOp, $upper] = \array_values($parts);
        $lowerOp = \preg_replace('/^</', '>', $lowerOp);

        return [
            'version' => "{$lowerOp}{$lower} {$upperOp}{$upper}",
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
                name: 'elm version',
                path: '/elm-package/elm-version/justinmimbs/date',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
