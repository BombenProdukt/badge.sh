<?php

declare(strict_types=1);

namespace App\Integrations\Keybase\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Keybase\Client;

final class KeyController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => 'PGP',
            'status'      => strtoupper(implode(' ', str_split(substr($response['them']['public_keys']['primary']['key_fingerprint'], -16), 4))),
            'statusColor' => 'blue.600',
        ];
    }
}
