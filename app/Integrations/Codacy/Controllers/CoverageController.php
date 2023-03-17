<?php

declare(strict_types=1);

namespace App\Integrations\Codacy\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractCoverageColor;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\Codacy\Client;

final class CoverageController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $projectId, ?string $branch = null): array
    {
        preg_match('/text-anchor=[^>]*?>([^<]+)<\//i', $this->client->get('coverage', $projectId, $branch), $matches);

        $percentage = trim($matches[1]);

        return [
            'label'  => 'coverage',
            'status' => FormatPercentage::execute($percentage),
            'color'  => ExtractCoverageColor::execute((float) $percentage),
        ];
    }
}
