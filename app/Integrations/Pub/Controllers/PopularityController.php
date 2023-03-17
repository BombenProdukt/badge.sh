<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\Pub\Client;

final class PopularityController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $percentage = (float) $this->client->api("packages/{$package}/score")['popularityScore'];

        return [
            'label'       => 'popularity',
            'status'      => FormatPercentage::execute($percentage * 100),
            'statusColor' => 'green.600',
        ];
    }
}
