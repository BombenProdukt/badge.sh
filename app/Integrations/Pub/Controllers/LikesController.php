<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Pub\Client;
use Illuminate\Routing\Controller;

final class LikesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $likeCount = $this->client->api("packages/{$package}/score")['likeCount'];

        return [
            'label'       => 'popularity',
            'status'      => FormatNumber::execute($likeCount),
            'statusColor' => 'green.600',
        ];
    }
}
