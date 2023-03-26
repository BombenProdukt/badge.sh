<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LinesBadge extends AbstractBadge
{
    protected array $routes = [
        '/codeclimate/lines/{project:packageWithVendorOnly}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project): array
    {
        return [
            'lines' => $this->client->get($project, 'snapshots')['attributes']['lines_of_code'],
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
                name: 'lines of code',
                path: '/codeclimate/lines/codeclimate/codeclimate',
                data: $this->render(['lines' => '1000']),
            ),
        ];
    }
}
