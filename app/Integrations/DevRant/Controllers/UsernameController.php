<?php

declare(strict_types=1);

namespace App\Integrations\DevRant\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\DevRant\Client;

final class UsernameController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $username): array
    {
        $profile = $this->client->get($this->client->getUserIdFromName($username));

        return [
            'label'       => ucfirst($profile['username']),
            'status'      => FormatNumber::execute($profile['score']),
            'statusColor' => 'f99a66',
        ];
    }
}
