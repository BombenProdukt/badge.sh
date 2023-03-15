<?php

declare(strict_types=1);

namespace App\Integrations\MozillaAddOns\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\MozillaAddOns\Client;
use Illuminate\Routing\Controller;

final class UsersController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'users',
            'status'      => FormatNumber::execute($response['average_daily_users']),
            'statusColor' => 'green.600',
        ];
    }
}
