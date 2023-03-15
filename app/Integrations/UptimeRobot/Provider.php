<?php

declare(strict_types=1);

namespace App\Integrations\UptimeRobot;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Uptime Robot';
    }

    public function register(): void
    {
        Route::prefix('uptime-robot')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/uptime-robot/status/m780862024-50db2c44c703e5c68d6b1ebb'   => 'status',
            '/uptime-robot/day/m780862024-50db2c44c703e5c68d6b1ebb'      => '(24 hours) uptime',
            '/uptime-robot/week/m780862024-50db2c44c703e5c68d6b1ebb'     => '(past week) uptime',
            '/uptime-robot/month/m780862024-50db2c44c703e5c68d6b1ebb'    => '(past month) uptime',
            '/uptime-robot/response/m780862024-50db2c44c703e5c68d6b1ebb' => '(last hour) response',
        ];
    }
}
