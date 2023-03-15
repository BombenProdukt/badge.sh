<?php

declare(strict_types=1);

namespace App\Integrations\DevRant\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\DevRant\Client;
use Illuminate\Routing\Controller;

final class UserIdController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $userId): array
    {
        $profile = $this->client->get($userId);

        return [
            'label'       => ucfirst($profile['username']),
            'status'      => FormatNumber::execute($profile['score']),
            'statusColor' => 'f99a66',
        ];
    }
}
