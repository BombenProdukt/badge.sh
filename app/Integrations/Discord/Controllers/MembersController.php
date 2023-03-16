<?php

declare(strict_types=1);

namespace App\Integrations\Discord\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Discord\Client;
use Illuminate\Routing\Controller;

final class MembersController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $inviteCode): array
    {
        $response = $this->client->get($inviteCode);

        return [
            'label'       => $response['guild']['name'] ?? 'discord',
            'status'      => FormatNumber::execute($response['approximate_member_count']).' members',
            'statusColor' => '7289DA',
        ];
    }
}
