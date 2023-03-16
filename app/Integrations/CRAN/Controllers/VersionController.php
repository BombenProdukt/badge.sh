<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\CRAN\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->db($package);

        return [
            'label'        => 'cran',
            'status'       => ExtractVersion::execute($response['Version']),
            'statusColor'  => ExtractVersionColor::execute($response['Version']),
        ];
    }
}
