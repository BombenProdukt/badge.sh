<?php

declare(strict_types=1);

namespace App\Integrations\Discord\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Discord\Client;

final class MembersController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $inviteCode): array
    {
        $response = $this->client->get($inviteCode);

        return [
            'label'       => $response['guild']['name'] ?? 'discord',
            'status'      => FormatNumber::execute($response['approximate_member_count']).' members',
            'statusColor' => '7289DA',
        ];
    }
}
