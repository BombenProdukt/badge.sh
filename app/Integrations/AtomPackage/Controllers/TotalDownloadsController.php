<?php

declare(strict_types=1);

namespace App\Integrations\AtomPackage\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\AtomPackage\Client;
use Illuminate\Routing\Controller;

final class TotalDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->get($package)['downloads']),
            'statusColor' => 'green.600',
        ];
    }
}
