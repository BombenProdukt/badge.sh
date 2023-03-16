<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate\Controllers;

use App\Integrations\Actions\ExtractCoverageColor;
use App\Integrations\CodeClimate\Client;
use Illuminate\Routing\Controller;

final class CoverageLetterController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'test_reports');

        return [
            'label'       => 'coverage',
            'status'      => $response['attributes']['rating']['letter'],
            'statusColor' => ExtractCoverageColor::execute($response['attributes']['rating']['measure']['value']),
        ];
    }
}
