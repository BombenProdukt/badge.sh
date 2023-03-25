<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DependentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/cpan/dependents/{distribution}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $distribution): array
    {
        return [
            'count' => $this->client->get("reverse_dependencies/dist/{$distribution}")['total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependents', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependents',
                path: '/cpan/dependents/DateTime',
                data: $this->render([]),
            ),
        ];
    }
}
