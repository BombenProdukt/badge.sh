<?php

declare(strict_types=1);

namespace App\Integrations\LGTM;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'LGTM';
    }

    public function register(): void
    {
        Route::prefix('lgtm')->group(function (): void {
            //
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
