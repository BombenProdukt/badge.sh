<?php

declare(strict_types=1);

namespace App\Integrations\Codacy\Controllers;

use App\Integrations\Actions\ExtractCoverageColor;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\Codacy\Client;
use Illuminate\Routing\Controller;

final class CoverageController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $projectId, ?string $branch = null): array
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
