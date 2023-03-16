<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\WAPM\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'        => 'wapm',
            'status'       => ExtractVersion::execute($response['version']),
            'statusColor'  => ExtractVersionColor::execute($response['version']),
        ];
    }
}
