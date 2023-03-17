<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Client;

final class LabelsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, string $label, ?string $states = ''): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, $this->getQueryBody($label, $states));

        return [
            'label'       => $label,
            'status'      => $result['label'] ? $result['label']['issues']['totalCount'] : 0,
            'statusColor' => $result['label'] ? $result['label']['color'] : 'grey.600',
        ];
    }

    private function getQueryBody(string $label, string $states): string
    {
        $issueFilter = $states ? '(states:['.strtoupper($states).'])' : '';

        return "label(name:\"{$label}\") { color, issues{$issueFilter} { totalCount } }";
    }
}
