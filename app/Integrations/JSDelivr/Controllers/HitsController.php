<?php

declare(strict_types=1);

namespace App\Integrations\JSDelivr\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\JSDelivr\Client;
use Illuminate\Routing\Controller;

final class HitsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $platform, string $package): array
    {
        $total = $this->client->data($platform, $package)['total'];

        return [
            'label'       => 'jsDelivr',
            'status'      => FormatNumber::execute($total).'/month',
            'statusColor' => 'green.600',
        ];
    }
}
