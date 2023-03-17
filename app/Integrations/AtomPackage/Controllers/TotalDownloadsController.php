<?php

declare(strict_types=1);

namespace App\Integrations\AtomPackage\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\AtomPackage\Client;

final class TotalDownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->get($package)['downloads']),
            'statusColor' => 'green.600',
        ];
    }
}
