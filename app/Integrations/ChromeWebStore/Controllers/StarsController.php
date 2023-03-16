<?php

declare(strict_types=1);

namespace App\Integrations\ChromeWebStore\Controllers;

use App\Integrations\ChromeWebStore\Client;
use Illuminate\Routing\Controller;

/**
 * @TODO
 */
final class StarsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $itemId): array
    {
        $response = $this->client->get($itemId);

        return [
            'label'       => 'TODO',
            'status'      => 'TODO',
            'statusColor' => 'TODO',
        ];
    }
}
