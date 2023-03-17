<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\VisualStudioMarketplace\Client;

final class DownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $extension): array
    {
        $response    = collect($this->client->get($extension));
        $install     = collect($response['statistics'])->firstWhere('statisticName', 'install')['value'];
        $updateCount = collect($response['statistics'])->firstWhere('statisticName', 'updateCount')['value'];

        return [
            'label'        => 'downloads',
            'status'       => FormatNumber::execute($install + $updateCount),
            'statusColor'  => 'green.600',
        ];
    }
}
