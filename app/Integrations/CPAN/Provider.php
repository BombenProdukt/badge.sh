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
            //
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
