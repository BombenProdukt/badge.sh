<?php

declare(strict_types=1);

namespace App\Integrations\CocoaPods\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\CocoaPods\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $pod): array
    {
        $response = $this->client->get($pod);

        return [
            'label'       => 'pod',
            'status'      => ExtractVersion::execute($response['version']),
            'statusColor' => ExtractVersionColor::execute($response['version']),
        ];
    }
}
