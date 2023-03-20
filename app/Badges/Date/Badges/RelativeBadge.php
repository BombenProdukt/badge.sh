<?php

declare(strict_types=1);

namespace App\Badges\Date\Badges;

use App\Badges\Date\Client;
use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use Carbon\Carbon;
use Illuminate\Routing\Route;

final class RelativeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $timestamp): array
    {
        return TextTemplate::make('date', Carbon::createFromTimestamp($timestamp)->diffForHumans(), 'blue.600');
    }

    public function service(): string
    {
        return 'Date';
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
            '/date/relative/{timestamp}',
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
        $route->whereNumber('timestamp');
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
            '/date/relative/1540814400' => 'relative date',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
