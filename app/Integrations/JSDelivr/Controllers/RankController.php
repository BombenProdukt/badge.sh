<?php

declare(strict_types=1);

namespace App\Integrations\JSDelivr\Controllers;

use App\Integrations\JSDelivr\Client;
use Illuminate\Routing\Controller;

final class RankController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $platform, string $package): array
    {
        $rank = $this->client->data($platform, $package)['rank'];

        return [
            'label'       => 'jsDelivr rank',
            'status'      => $rank ? "#{$rank}" : 'none',
            'statusColor' => $rank ? 'blue.600' : 'grey.600',
        ];
    }
}
