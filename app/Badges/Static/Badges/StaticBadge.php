<?php

declare(strict_types=1);

namespace App\Badges\Static\Badges;

use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StaticBadge implements Badge
{
    public function handle(string $label, string $message, ?string $messageColor = 'green.600'): array
    {
        return [
            'label'        => $label,
            'message'      => $message,
            'messageColor' => $messageColor,
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
            '/static/{label}/{message}/{messageColor?}',
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
            '/static/Swift/4.2/orange'          => 'swift version',
            '/static/license/MIT/blue'          => 'license MIT',
            '/static/chat/on%20gitter/cyan'     => 'chat on gitter',
            '/static/stars/★★★★☆'               => 'star rating',
            '/static/become/a%20patron/F96854'  => 'patron',
            '/static/code%20style/standard/f2a' => 'code style: standard',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
