<?php

declare(strict_types=1);

namespace App\Badges\NPMS\Badges;

use App\Enums\Category;

final class MaintenanceScoreBadge extends AbstractBadge
{
    protected array $routes = [
        '/npms/maintenance-score/{package}',
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
        return $this->renderNumber('maintenance', $properties['maintenance']);
    }

    public function previews(): array
    {
        return [
            '/npms/maintenance-score/chalk' => 'maintenance score',
        ];
    }
}
