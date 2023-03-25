<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/greasyfork/license/{scriptId}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $scriptId): array
    {
        return $this->client->get($scriptId);
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            '/greasyfork/license/407466' => 'license',
        ];
    }
}
