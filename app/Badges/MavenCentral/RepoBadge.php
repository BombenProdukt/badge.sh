<?php

declare(strict_types=1);

namespace App\Badges\MavenCentral;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RepoBadge extends AbstractBadge
{
    protected string $route = '/maven-central/version/{group}/{artifact}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $group, string $artifact): array
    {
        $response = $this->client->get(\str_replace('.', '/', $group)."/{$artifact}/maven-metadata.xml");

        \preg_match('/<latest>(?<version>.+)<\/latest>/', $response, $matches);

        return [
            'version' => $matches[1],
        ];
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
                path: '/maven-central/version/com.google.code.gson/gson',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
