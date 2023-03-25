<?php

declare(strict_types=1);

namespace App\Badges\NPMS\Badges;

use App\Enums\Category;

final class QualityScoreBadge extends AbstractBadge
{
    protected array $routes = [
        '/npms/quality-score/{package}',
    ];

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
            '/npms/quality-score/chalk' => 'quality score',
        ];
    }
}
