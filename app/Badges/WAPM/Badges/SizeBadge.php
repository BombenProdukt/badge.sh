<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Actions\FormatBytes;
use App\Badges\WAPM\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class SizeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return [
            'label'        => 'distrib size',
            'status'       => FormatBytes::execute($this->client->get($package)['distribution']['size']),
            'statusColor'  => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'WAPM';
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
            '/wapm/size/{package}',
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
        $route->where('package', '.+');
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
            '/wapm/size/coreutils' => 'size',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
