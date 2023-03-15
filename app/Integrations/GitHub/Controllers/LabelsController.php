<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\GitHub\Client;
use Illuminate\Routing\Controller;

final class LabelsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, string $label, ?string $states = ''): array
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
