<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://marketplace.visualstudio.com/_apis/public/gallery/')->throw();
    }

    public function get(string $extension): array
    {
        return $this->client->post('extensionquery?api-version=3.0-preview.1', [
            'filters' => [['criteria' => [['filterType' => 7, 'value' => $extension]]]],
            'flags'   => 914,
        ])->json('results.0.extensions.0');
    }
}
