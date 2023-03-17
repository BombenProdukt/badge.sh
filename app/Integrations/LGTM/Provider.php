<?php

declare(strict_types=1);

namespace App\Integrations\LGTM;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\DeprecatedController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    private array $providers = [
        'g', 'github',
        'b', 'bitbucket',
        'gl', 'gitlab',
    ];

    public function name(): string
    {
        return 'LGTM';
    }

    public function register(): void
    {
        Route::prefix('lgtm')->group(function (): void {
            Route::get('alerts/{provider}/{owner}/{name}/{language?}', DeprecatedController::class)->whereIn('provider', $this->providers);
            Route::get('grade/{provider}/{owner}/{name}/{language?}', DeprecatedController::class)->whereIn('provider', $this->providers);
            Route::get('lines/{provider}/{owner}/{name}/{language?}', DeprecatedController::class)->whereIn('provider', $this->providers);
            Route::get('langs/{provider}/{owner}/{name}/{language?}', DeprecatedController::class)->whereIn('provider', $this->providers);
        });
    }

    public function examples(): array
    {
        return [
            '/lgtm/langs/g/apache/cloudstack/java'                   => 'langs',
            '/lgtm/alerts/g/apache/cloudstack'                       => 'alerts',
            '/lgtm/lines/g/apache/cloudstack/java'                   => 'lines (java)',
            '/lgtm/grade/g/apache/cloudstack/java'                   => 'grade (java)',
            '/lgtm/grade/g/apache/cloudstack'                        => 'grade (auto)',
            '/lgtm/grade/g/systemd/systemd'                          => 'grade (auto)',
            '/lgtm/grade/bitbucket/wegtam/bitbucket-youtrack-broker' => 'grade (auto)',
            '/lgtm/grade/gitlab/nekokatt/hikari'                     => 'grade (auto)',
        ];
    }
}
