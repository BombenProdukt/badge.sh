<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;
use Illuminate\Routing\Controller;

final class LabelsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, string $label, ?string $state = null): array
    {
        $stateFilter = $state ? 'state:'.strtolower($state) : '';
        $response    = $this->client->graphql($owner, $repo, "issues(labelName:\"{$label}\", {$stateFilter}) { count } label(title: \"{$label}\"){ color }");

        return [
            'label'       => $label,
            'status'      => FormatNumber::execute($response['issues']['count']),
            'statusColor' => 'blue.600',
        ];
    }
}
