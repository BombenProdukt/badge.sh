<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/cpan/license/{distribution}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $distribution): array
    {
        return $this->client->get("release/{$distribution}");
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/cpan/license/Perl::Tidy',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
