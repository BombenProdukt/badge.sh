<?php

declare(strict_types=1);

namespace App\Badges\MavenMetadata\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/maven-metadata/version/{hostname}/{pathname:wildcard}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $hostname, string $pathname): array
    {
        $response = Http::get("https://{$hostname}/{$pathname}")->throw()->body();

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
                name: 'version (maven metadata url)',
                path: '/maven-metadata/version/repo1.maven.org/maven2/com/google/code/gson/gson/maven-metadata.xml',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
