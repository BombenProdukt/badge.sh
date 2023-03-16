<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\VisualStudioMarketplace\Client;
use Illuminate\Routing\Controller;

final class DownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $extension): array
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
