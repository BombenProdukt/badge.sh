<?php

declare(strict_types=1);

namespace App\Integrations\DevRant\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\DevRant\Client;

final class UserIdController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $userId): array
    {
        $profile = $this->client->get($userId);

        return [
            'label'       => ucfirst($profile['username']),
            'status'      => FormatNumber::execute($profile['score']),
            'statusColor' => 'f99a66',
        ];
    }
}
