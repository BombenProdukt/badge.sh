<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/pub/license/{package}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package): array
    {
        $response = $this->client->web("packages/{$package}");

        \preg_match('/License<\/h3>\s*<p>([^(]+)\(/i', $response, $matches);

        return $this->renderLicense($matches[1]);
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
            '/pub/license/pubx' => 'license',
        ];
    }
}
