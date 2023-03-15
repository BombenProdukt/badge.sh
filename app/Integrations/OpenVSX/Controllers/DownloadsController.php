<?php

declare(strict_types=1);

namespace App\Integrations\OpenVSX\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\OpenVSX\Client;
use Illuminate\Routing\Controller;

final class DownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $namespace, string $package): array
    {
        $response = $this->client->get($namespace, $package);

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($response['downloadCount']),
            'statusColor' => 'green.600',
        ];
    }
}
