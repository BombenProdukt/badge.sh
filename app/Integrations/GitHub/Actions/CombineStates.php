<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Actions;

use Illuminate\Support\Collection;
use InvalidArgumentException;

final class CombineStates
{
    public static function execute(Collection $states, string $stateKey = 'state'): string
    {
        if ($states->isEmpty()) {
            return 'unknown';
        }

        if ($states->firstWhere($stateKey, 'failure')) {
            return 'failure';
        }

        if ($states->firstWhere($stateKey, 'timed_out')) {
            return 'timed_out';
        }

        if ($states->firstWhere($stateKey, 'action_required')) {
            return 'action_required';
        }

        $succeeded = $states
            ->filter(fn (array $x) => $x[$stateKey] !== 'neutral')
            ->filter(fn (array $x) => $x[$stateKey] !== 'cancelled')
            ->filter(fn (array $x) => $x[$stateKey] !== 'skipped')
            ->every(fn (array $x) => $x[$stateKey] === 'success');

        if ($succeeded) {
            return 'success';
        }

        throw new InvalidArgumentException('Unknown states');
    }
}
