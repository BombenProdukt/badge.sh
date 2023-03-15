<?php

declare(strict_types=1);

namespace App\Integrations\MozillaAddOns\Controllers;

use App\Integrations\Actions\FormatStars;
use App\Integrations\MozillaAddOns\Client;
use Illuminate\Routing\Controller;

final class StarsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'stars',
            'status'      => FormatStars::execute($response['ratings']['average']),
            'statusColor' => 'green.600',
        ];
    }
}
