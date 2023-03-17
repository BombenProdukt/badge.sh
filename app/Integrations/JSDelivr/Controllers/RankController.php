<?php

declare(strict_types=1);

namespace App\Integrations\JSDelivr\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\JSDelivr\Client;

final class RankController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $platform, string $package): array
    {
        $rank = $this->client->data($platform, $package)['rank'];

        return [
            'label'       => 'jsDelivr rank',
            'status'      => $rank ? "#{$rank}" : 'none',
            'statusColor' => $rank ? 'blue.600' : 'grey.600',
        ];
    }
}
