<?php

declare(strict_types=1);

namespace App\Integrations\Docker\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Docker\Client;
use Illuminate\Routing\Controller;

final class StarsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $scope, string $name): array
    {
        return [
            'label'       => 'docker pulls',
            'status'      => FormatNumber::execute($this->client->info($scope, $name)['star_count']),
            'statusColor' => 'blue.600',
        ];
    }
}
