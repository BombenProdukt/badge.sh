<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;

final class PerlBadge extends AbstractBadge
{
    protected array $routes = [
        '/cpan/perl-version/{distribution}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT, Category::VERSION,
    ];

    public function handle(string $distribution): array
    {
        $version = \str_replace('_', '', $this->client->get("release/{$distribution}")['metadata']['prereqs']['runtime']['requires']['perl']);

        if (!$version || \str_starts_with($version, 'v')) {
            return $version;
        }

        [$major, $rest] = \explode('.', $version, 2);
        $minor = \mb_substr($rest, 0, 3);
        $patch = \str_pad(\mb_substr($rest, 3), 3, '0', \STR_PAD_RIGHT);

        return [
            'version' => \implode('.', \array_map('intval', [$major, $minor, $patch])),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'Perl');
    }

    public function previews(): array
    {
        return [
            '/cpan/perl-version/Plack' => 'perl version',
        ];
    }
}
