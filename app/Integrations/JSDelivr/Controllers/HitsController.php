<?php

declare(strict_types=1);

namespace App\Integrations\JSDelivr\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\JSDelivr\Client;

final class HitsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $platform, string $package): array
    {
        $total = $this->client->data($platform, $package)['total'];

        return [
            'label'       => 'jsDelivr',
            'status'      => FormatNumber::execute($total).'/month',
            'statusColor' => 'green.600',
        ];
    }
}
