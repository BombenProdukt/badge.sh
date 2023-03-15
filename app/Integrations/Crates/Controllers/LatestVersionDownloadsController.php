<?php

declare(strict_types=1);

namespace App\Integrations\Crates\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Crates\Client;
use Illuminate\Routing\Controller;

final class LatestVersionDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->get($package)['recent_downloads']).' latest version',
            'statusColor' => 'green.600',
        ];
    }
}
