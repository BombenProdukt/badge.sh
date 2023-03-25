<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cpan/license/Perl::Tidy' => 'license',
        ];
    }
}
