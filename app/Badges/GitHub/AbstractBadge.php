<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Badges\AbstractBadge as Badge;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use PreemStudio\Formatter\FormatNumber;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'GitHub';

    public function __construct(protected readonly Client $client)
    {
        //
    }

    public function combineStates(Collection $states, string $stateKey = 'state'): string
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

        if ($states->firstWhere($stateKey, 'in_progress')) {
            return 'in_progress';
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

    protected function requestDependents(string $owner, string $repo, string $type): array
    {
        $subject = $type === 'PACKAGE' ? 'pkg dependents' : 'repo dependents';
        $keyword = $type === 'PACKAGE' ? 'Packages' : 'Repositories';

        $html = Http::get("https://github.com/{$owner}/{$repo}/network/dependents")->throw()->body();
        $reDependents = '/svg>\s*[\d,]+\s*'.\preg_quote($keyword).'/';

        \preg_match($reDependents, $html, $matches);
        $count = $matches[0] ? (int) \preg_replace('/[^\d]/', '', $matches[0]) : 0;

        if ($count === 0) {
            return [
                'label' => $subject,
                'message' => 'invalid',
                'messageColor' => 'gray.600',
            ];
        }

        return [
            'label' => $subject,
            'message' => FormatNumber::execute($count),
            'messageColor' => 'blue.600',
        ];
    }
}
