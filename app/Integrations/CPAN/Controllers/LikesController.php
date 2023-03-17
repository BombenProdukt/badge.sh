<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\CPAN\Client;

final class LikesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $distribution): array
    {
        return [
            'label'       => 'likes',
            'status'      => FormatNumber::execute($this->client->get('favorite/agg_by_distributions', ['distribution' => $distribution])['favorites'][$distribution] ?? 0),
            'statusColor' => 'green.600',
        ];
    }
}
