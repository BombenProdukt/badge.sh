<?php

declare(strict_types=1);

namespace App\Badges\CPAN;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/cpan/version/{distribution}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $distribution): array
    {
        return [
            'version' => $this->normalizeVersion($this->client->get("release/{$distribution}")['version']),
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
                path: '/cpan/version/App::cpanminus',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }

    private function normalizeVersion(string $version): string
    {
        $version = \str_replace('_', '', $version);

        if (!$version || \str_starts_with($version, 'v')) {
            return $version;
        }
        [$major, $rest] = \explode('.', $version, 2);
        $minor = \mb_substr($rest, 0, 3);
        $patch = \str_pad(\mb_substr($rest, 3), 3, '0', \STR_PAD_RIGHT);

        return \implode('.', \array_map('intval', [$major, $minor, $patch]));
    }
}
