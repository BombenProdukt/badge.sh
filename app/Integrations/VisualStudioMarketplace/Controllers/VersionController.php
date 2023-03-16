<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\VisualStudioMarketplace\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $extension): array
    {
        $version = $this->client->get($extension)['versions'][0]['version'];

        return [
            'label'        => 'VS Marketplace',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
