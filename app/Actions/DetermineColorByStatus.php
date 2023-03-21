<?php

declare(strict_types=1);

namespace App\Actions;

final class DetermineColorByStatus
{
    public static function execute(string $status): string
    {
        return match ($status) {
            'aborted'                => 'blue.600',
            'broken'                 => 'red.600',
            'building'               => 'blue.600',
            'canceled'               => 'blue.600',
            'cancelled'              => 'blue.600',
            'created'                => 'blue.600',
            'error'                  => 'red.600',
            'errored'                => 'red.600',
            'expired'                => 'blue.600',
            'failed'                 => 'red.600',
            'failing'                => 'red.600',
            'failure'                => 'red.600',
            'fixed'                  => 'green.600',
            'infrastructure_failure' => 'red.600',
            'initiated'              => 'blue.600',
            'no builds'              => 'blue.600',
            'no tests'               => 'blue.600',
            'not built'              => 'blue.600',
            'not run'                => 'blue.600',
            'partially succeeded'    => 'orange.600',
            'passed'                 => 'green.600',
            'passing'                => 'green.600',
            'pending'                => 'blue.600',
            'preloaded'              => 'green.600',
            'processing'             => 'blue.600',
            'queued'                 => 'blue.600',
            'running'                => 'blue.600',
            'scheduled'              => 'blue.600',
            'skipped'                => 'blue.600',
            'starting'               => 'blue.600',
            'stopped'                => 'blue.600',
            'succeeded'              => 'green.600',
            'success'                => 'green.600',
            'successful'             => 'green.600',
            'testing'                => 'blue.600',
            'timeout'                => 'orange.600',
            'unstable'               => 'orange.600',
            'waiting'                => 'blue.600',
            default                  => 'gray.600'
        };
    }
}
