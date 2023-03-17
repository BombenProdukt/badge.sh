<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'licenseInfo { spdxId }');

        return [
            'label'       => 'license',
            'status'      => $result['licenseInfo'] ? $result['licenseInfo']['spdxId'] : 'no license',
            'statusColor' => $result['licenseInfo'] ? 'blue.600' : 'grey.600',
        ];
    }
}
