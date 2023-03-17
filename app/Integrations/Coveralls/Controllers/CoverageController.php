<?php

declare(strict_types=1);

namespace App\Integrations\Coveralls\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractCoverageColor;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\Coveralls\Client;

final class CoverageController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $vcs, string $owner, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($vcs, $owner, $repo, $branch);

        preg_match('/_(\d+)\.svg/', $response, $matches);

        if (! is_numeric($matches[1])) {
            return [
                'subject'     => 'coverage',
                'status'      => 'invalid',
                'statusColor' => 'grey.600',
            ];
        }

        return [
            'label'       => 'coverage',
            'status'      => FormatPercentage::execute($matches[1]),
            'statusColor' => ExtractCoverageColor::execute((float) $matches[1]),
        ];
    }
}
