<?php

declare(strict_types=1);

namespace App\Integrations\Keybase\Controllers;

use App\Integrations\Keybase\Client;
use Illuminate\Routing\Controller;

final class KeyController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'PGP',
            'status'      => strtoupper(implode(' ', str_split(substr($response['them']['public_keys']['primary']['key_fingerprint'], -16), 4))),
            'statusColor' => 'blue.600',
        ];
    }
}
