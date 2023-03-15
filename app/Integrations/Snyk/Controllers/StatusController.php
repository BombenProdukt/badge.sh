<?php

declare(strict_types=1);

namespace App\Integrations\Snyk\Controllers;

use App\Integrations\Snyk\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, ?string $branch = null, ?string $targetFile = null): array
    {
        $svg = $this->client->get(implode('/', [$owner, $repo, $branch]), $targetFile);

        preg_match_all('/fill-opacity=[^>]*?>([^<]+)<\//i', $svg, $matchesText);
        [$subject, $status] = $matchesText[1];

        if (! preg_match('/<path[^>]*?fill="([^"]+)"[^>]*?d="M[^0]/i', $svg, $matchesColor)) {
            return [];
        }

        $statusColor = trim(str_replace('#', '', $matchesColor[1]));

        if (is_null($status) || empty($statusColor)) {
            return [];
        }

        return [
            'label'       => $subject ?? 'vulnerabilities',
            'status'      => $status,
            'statusColor' => $statusColor,
        ];
    }
}
