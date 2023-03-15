<?php

declare(strict_types=1);

namespace App\Integrations\Codecov\Controllers;

use App\Integrations\Actions\ExtractCoverageColor;
use App\Integrations\Codecov\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $vcs, string $owner, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($vcs, $owner, $repo, $branch);
        $coverage = (float) $response['commit']['totals']['c'];

        return [
            'label'       => 'coverage',
            'status'      => number_format($coverage, 2).'%',
            'statusColor' => ExtractCoverageColor::execute($coverage),
        ];
    }
}
