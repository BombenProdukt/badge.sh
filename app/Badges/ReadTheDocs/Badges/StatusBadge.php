<?php

declare(strict_types=1);

namespace App\Badges\ReadTheDocs\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Spatie\Regex\Regex;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/readthedocs/status/{project}/{version?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $project, ?string $version = null): array
    {
        return [
            'status' => Regex::match('|<text x="595" y="140" transform="scale\(.1\)" textLength="410">(.*)<\/text>|', $this->client->status($project, $version))->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('docs', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/readthedocs/status/pip',
                data: $this->render(['status' => 'success']),
            ),
            new BadgePreviewData(
                name: 'status',
                path: '/readthedocs/status/pip/stable',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
