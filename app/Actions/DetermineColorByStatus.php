<?php

declare(strict_types=1);

namespace App\Actions;

final class DetermineColorByStatus
{
    private static array $greenStatuses = [
        'fixed',
        'passed',
        'passing',
        'succeeded',
        'success',
        'successful',
    ];

    private static array $orangeStatuses = [
        'partially succeeded',
        'unstable',
        'timeout',
    ];

    private static array $redStatuses = [
        'broken',
        'error',
        'errored',
        'failed',
        'failing',
        'failure',
        'infrastructure_failure',
    ];

    private static array $otherStatuses = [
        'aborted',
        'building',
        'canceled',
        'cancelled',
        'created',
        'expired',
        'initiated',
        'no builds',
        'no tests',
        'not built',
        'not run',
        'pending',
        'processing',
        'queued',
        'running',
        'scheduled',
        'skipped',
        'starting',
        'stopped',
        'testing',
        'waiting',
    ];

    public static function execute(string $status): string
    {
        if (in_array($status, static::$greenStatuses)) {
            return 'green.600';
        }

        if (in_array($status, static::$orangeStatuses)) {
            return 'orange.600';
        }

        if (in_array($status, static::$redStatuses)) {
            return 'red.600';
        }

        return 'gray.600';
    }
}
