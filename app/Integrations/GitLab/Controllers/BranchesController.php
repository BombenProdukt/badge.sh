<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;
use Illuminate\Routing\Controller;

final class BranchesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $response = $this->client->rest($owner, $repo, 'repository/branches');

        return [
            'label'       => 'branches',
            'status'      => FormatNumber::execute((int) $response->header('x-total')),
            'statusColor' => 'blue.600',
        ];
    }
}
