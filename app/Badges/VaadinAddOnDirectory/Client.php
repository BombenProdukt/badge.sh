<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://vaadin.com')->throw();
    }

    public function get(string $packageName): array
    {
        return $this->client->get('vaadincom/directory-service/components/search/findByUrlIdentifier', [
            'projection' => 'summary',
            'urlIdentifier' => $packageName,
        ])->json();
    }
}
