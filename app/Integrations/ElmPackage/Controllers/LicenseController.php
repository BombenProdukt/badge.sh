<?php

declare(strict_types=1);

namespace App\Integrations\ElmPackage\Controllers;

use App\Integrations\ElmPackage\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $name): array
    {
        $license = $this->client->get($owner, $name)['license'];

        return [
            'label'        => 'license',
            'status'       => $license,
            'statusColor'  => 'blue.600',
        ];
    }
}
