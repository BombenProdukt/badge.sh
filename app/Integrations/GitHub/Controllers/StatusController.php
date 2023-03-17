<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Actions\CombineStates;
use App\Integrations\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Collection;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, ?string $reference = null, ?string $context = null): array
    {
        if (empty($reference)) {
            $response  = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $response = GitHub::connection('main')->api('repo')->statuses()->combined($owner, $repo, $reference);

        if (is_string($context)) {
            $state = collect($response['statuses'])->filter(fn (array $check) => str_contains(strtolower($check['context']), $context));
        } else {
            $state = $response['state'];
        }

        if ($state instanceof Collection) {
            $state = CombineStates::execute($state, 'state');
        }

        if (is_string($state)) {
            return [
                'label'       => $context ?: 'status',
                'status'      => $state,
                'statusColor' => [
                    'pending' => 'orange.600',
                    'success' => 'green.600',
                    'failure' => 'red.600',
                    'error'   => 'red.600',
                    'unknown' => 'gray.600',
                ][$state],
            ];
        }

        return [
            'label'       => 'status',
            'status'      => 'unknown',
            'statusColor' => 'gray.600',
        ];
    }
}
