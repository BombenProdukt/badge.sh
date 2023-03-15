<?php

declare(strict_types=1);

namespace App\Integrations\JSDelivr\Controllers;

use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\JSDelivr\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $version = $this->client->cdn($package)['version'];

        return [
            'label'        => 'jsDelivr',
            'status'       => "v{$version}",
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
