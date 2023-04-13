<?php

declare(strict_types=1);

namespace App\Badges\Tokei;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LinesBadge extends AbstractBadge
{
    protected string $route = '/tokei/lines/{provider}/{user}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $provider, string $user, string $repo): array
    {
        return [
            'lines' => $this->client->lines($provider, $user, $repo),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLines($properties['lines']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/tokei/lines/github/badges/shields',
                data: $this->render(['lines' => '1000']),
            ),
        ];
    }
}
