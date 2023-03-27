<?php

declare(strict_types=1);

namespace App\Badges\NPMS\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class QualityScoreBadge extends AbstractBadge
{
    protected string $route = '/npms/quality-score/{package}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $package): array
    {
        return $this->client->get($package)['detail'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('quality', $properties['quality']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'quality score',
                path: '/npms/quality-score/chalk',
                data: $this->render(['quality' => '4.5']),
            ),
        ];
    }
}
