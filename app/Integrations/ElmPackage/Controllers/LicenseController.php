<?php

declare(strict_types=1);

namespace App\Integrations\ElmPackage\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\ElmPackage\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $name): array
    {
        $license = $this->client->get($owner, $name)['license'];

        return [
            'label'        => 'license',
            'status'       => $license,
            'statusColor'  => 'blue.600',
        ];
    }
}
