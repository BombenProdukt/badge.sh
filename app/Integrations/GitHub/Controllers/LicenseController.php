<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\GitHub\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'licenseInfo { spdxId }');

        return [
            'label'       => 'license',
            'status'      => $result['licenseInfo'] ? $result['licenseInfo']['spdxId'] : 'no license',
            'statusColor' => $result['licenseInfo'] ? 'blue.600' : 'grey.600',
        ];
    }
}
