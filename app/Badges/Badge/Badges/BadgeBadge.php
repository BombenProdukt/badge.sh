<?php

declare(strict_types=1);

namespace App\Badges\Badge\Badges;

use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class BadgeBadge implements Badge
{
    public function handle(string $label, string $status, ?string $statusColor = null): array
    {
        return [
            'label'        => $label,
            'message'      => $status,
            'messageColor' => $statusColor ? "{$statusColor}.600" : 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Badge';
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
            '/badge/{label}/{status}/{statusColor?}',
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
            '/badge/Swift/4.2/orange'          => 'swift version',
            '/badge/license/MIT/blue'          => 'license MIT',
            '/badge/chat/on%20gitter/cyan'     => 'chat on gitter',
            '/badge/stars/★★★★☆'               => 'star rating',
            '/badge/become/a%20patron/F96854'  => 'patron',
            '/badge/code%20style/standard/f2a' => 'code style: standard',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
