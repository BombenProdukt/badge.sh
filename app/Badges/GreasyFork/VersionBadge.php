<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/greasyfork/version/{scriptId}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $scriptId): array
    {
        return $this->client->get($scriptId);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/greasyfork/version/407466',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
