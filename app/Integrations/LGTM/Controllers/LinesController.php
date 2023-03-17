<?php

declare(strict_types=1);

namespace App\Integrations\LGTM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\LGTM\Client;

final class LinesController extends AbstractController
{
    private array $languages = [
        'cpp'        => 'c/c++',
        'csharp'     => 'c#',
        'javascript' => 'js/ts',
    ];

    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $provider, string $owner, string $name, ?string $language = null): array
    {
        $response = $this->client->get($provider, $owner, $name, $language);

        return [
            'label'       => $language ? 'lines: '.($this->languages[$response['lines']] ?? $language) : 'lines',
            'status'      => FormatNumber::execute($language ? $response['lines'] : array_reduce($response['languages'], fn ($accu, $curr) => $accu + $curr['lines'], 0)),
            'statusColor' => 'blue.600',
        ];
    }
}
