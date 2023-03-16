<?php

declare(strict_types=1);

namespace App\Integrations\CPAN;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'CPAN';
    }

    public function register(): void
    {
        Route::prefix('cpan')->group(function (): void {
            Route::get('v/{distribution}', Controllers\VersionController::class);
            Route::get('license/{distribution}', Controllers\LicenseController::class);
            Route::get('perl/{distribution}', Controllers\PerlController::class);
            Route::get('size/{distribution}', Controllers\SizeController::class);
            Route::get('dependents/{distribution}', Controllers\DependentsController::class);
            Route::get('likes/{distribution}', Controllers\LikesController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/cpan/v/App::cpanminus'    => 'version',
            '/cpan/license/Perl::Tidy'  => 'license',
            '/cpan/perl/Plack'          => 'perl version',
            '/cpan/size/Moose'          => 'size',
            '/cpan/dependents/DateTime' => 'dependents',
            '/cpan/likes/DBIx::Class'   => 'likes',
        ];
    }
}
