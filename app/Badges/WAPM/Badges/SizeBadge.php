<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WAPM\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatBytes;

final class SizeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return [
            'label'        => 'distrib size',
            'message'      => FormatBytes::execute($this->client->get($package)['distribution']['size']),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'WebAssembly Package Manager';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/wapm/size/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wapm/size/coreutils' => 'size',
        ];
    }
}
