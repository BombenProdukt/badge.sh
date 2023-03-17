<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Actions\CombineStates;
use App\Integrations\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, ?string $reference = '', ?string $context = ''): array
    {
        if (empty($reference)) {
            $response  = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $response = GitHub::connection('main')->api('repo')->statuses()->show($owner, $repo, $reference);

        if (is_string($context)) {
            $state = collect($response['statuses'])->filter(function (array $check) use ($context): bool {
                return str_contains(strtolower($check['context']), $context);
            });
        } else {
            $state = collect($response['state']);
        }

        if ($state->isNotEmpty()) {
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
                    'unknown' => 'grey.600',
                ][$state],
            ];
        }

        return [
            'label'       => 'status',
            'status'      => 'unknown',
            'statusColor' => 'grey.600',
        ];
    }
}
