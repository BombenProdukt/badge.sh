<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\DUB\Client;

final class MonthlyDownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $downloads = $this->client->get("{$package}/stats")['downloads'];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($downloads['monthly']).'/month',
            'statusColor' => 'green.600',
        ];
    }
}
