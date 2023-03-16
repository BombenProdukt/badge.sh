<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\CPAN\Client;
use Illuminate\Routing\Controller;

final class LikesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $distribution): array
    {
        return [
            'label'       => 'likes',
            'status'      => FormatNumber::execute($this->client->get('favorite/agg_by_distributions', ['distribution' => $distribution])['favorites'][$distribution] ?? 0),
            'statusColor' => 'green.600',
        ];
    }
}
