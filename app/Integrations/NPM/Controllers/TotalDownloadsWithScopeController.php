<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\NPM\Client;
use Illuminate\Routing\Controller;

final class TotalDownloadsWithScopeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $scope, string $package, string $tag = 'latest'): array
    {
        $downloads = $this->client->api('downloads/range/2005-01-01:'.date('Y')."-01-01/{$scope}/{$package}")['downloads'];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute(collect($downloads)->sum('downloads')),
            'statusColor' => 'green.600',
        ];
    }
}
