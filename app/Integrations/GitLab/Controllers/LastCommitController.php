<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\GitLab\Client;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

final class LastCommitController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, ?string $ref = null): array
    {
        $response = $this->client->rest($owner, $repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->json('0');

        return [
            'label'       => 'last commit',
            'status'      => Carbon::parse($response['committed_date'])->diffForHumans(),
            'statusColor' => 'green.600',
        ];
    }
}
