<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;
use Illuminate\Routing\Controller;

final class CommitsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, ?string $ref = null): array
    {
        $response = $this->client->rest($owner, $repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits');

        return [
            'label'       => 'commits',
            'status'      => FormatNumber::execute((int) $response->header('x-total')),
            'statusColor' => 'blue.600',
        ];
    }
}
