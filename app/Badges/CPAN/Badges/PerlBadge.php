<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Badges\CPAN\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class PerlBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $distribution): array
    {
        $version = $this->normalizeVersion($this->client->get("release/{$distribution}")['metadata']['prereqs']['runtime']['requires']['perl']);

        return VersionTemplate::make($this->service(), $version);
    }

    private function normalizeVersion(string $version): string
    {
        $version = str_replace('_', '', $version);
        if (! $version || str_starts_with($version, 'v')) {
            return $version;
        }
        [$major, $rest] = explode('.', $version, 2);
        $minor          = substr($rest, 0, 3);
        $patch          = str_pad(substr($rest, 3), 3, '0', STR_PAD_RIGHT);

        return implode('.', array_map('intval', [$major, $minor, $patch]));
    }

    public function service(): string
    {
        return 'CPAN';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/cpan/perl/{distribution}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cpan/perl/Plack' => 'perl version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
