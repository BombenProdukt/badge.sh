<?php

declare(strict_types=1);

namespace App\Integrations\Codecov\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractCoverageColor;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\Codecov\Client;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $vcs, string $owner, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($vcs, $owner, $repo, $branch);
        $coverage = (float) $response['commit']['totals']['c'];

        return [
            'label'       => 'coverage',
            'status'      => FormatPercentage::execute($coverage),
            'statusColor' => ExtractCoverageColor::execute($coverage),
        ];
    }
}
