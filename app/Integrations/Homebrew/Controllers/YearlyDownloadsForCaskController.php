<?php

declare(strict_types=1);

namespace App\Integrations\Homebrew\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Homebrew\Client;

final class YearlyDownloadsForCaskController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $count = $this->client->get('cask', $package)['analytics']['install']['365d'][$package];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($count).'/year',
            'statusColor' => 'green.600',
        ];
    }
}
