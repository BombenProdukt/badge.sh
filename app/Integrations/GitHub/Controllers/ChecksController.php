<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Actions\CombineStates;
use GrahamCampbell\GitHub\Facades\GitHub;

final class ChecksController extends AbstractController
{
    protected function handleRequest(string $owner, string $repo, ?string $reference = '', ?string $context = '')
    {
        if (empty($reference)) {
            $response  = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $response = GitHub::connection('main')->api('repo')->checkRuns()->allForReference($owner, $repo, $reference);

        $state = collect($response['check_runs']);

        if (is_string($context)) {
            $state = $state->filter(function (array $check) use ($context): bool {
                $checkName = str_contains(strtolower($check['name']), $context);
                $appName   = str_contains(strtolower($check['app']['slug']), $context);

                return $checkName || $appName;
            });
        }

        if ($state->isNotEmpty()) {
            $state = CombineStates::execute($state, 'conclusion');
        }

        if (is_string($state)) {
            return [
                'label'       => $context ?: 'checks',
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
            'label'       => 'checks',
            'status'      => 'unknown',
            'statusColor' => 'grey.600',
        ];
    }
}
