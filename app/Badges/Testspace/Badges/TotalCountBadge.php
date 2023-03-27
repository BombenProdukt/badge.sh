<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TotalCountBadge extends AbstractBadge
{
    protected string $route = '/testspace/total-count/{org}/{project}/{space}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $org, string $project, string $space): array
    {
        return [
            'downloads' => $this->client->get($org, $project, $space)['total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('total', $properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'total tests count',
                path: '/testspace/total-count/swellaby/swellaby:testspace-sample/main',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
