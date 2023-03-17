<?php

declare(strict_types=1);

namespace App\Integrations\ChromeWebStore\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\ChromeWebStore\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $itemId): array
    {
        preg_match('|<span class="C-b-p-D-Xe h-C-b-p-D-md">(.*?)</span>|', $this->client->get($itemId), $matches);

        return [
            'label'       => 'chrome web store',
            'status'      => ExtractVersion::execute($matches[1]),
            'statusColor' => ExtractVersionColor::execute($matches[1]),
        ];
    }
}
