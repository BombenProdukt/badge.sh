<?php

declare(strict_types=1);

namespace App\Integrations\Codacy\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Codacy\Client;

final class GradeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $projectId, ?string $branch = null): array
    {
        preg_match('/visibility=[^>]*?>([^<]+)<\//i', $this->client->get('grade', $projectId, $branch), $matches);

        $status = trim($matches[1]);

        return [
            'label'       => 'code quality',
            'status'      => $status,
            'statusColor' => [
                'A' => '4ac41c',
                'B' => '98c510',
                'C' => '9fa126',
                'D' => 'd7b024',
                'E' => 'f17d3e',
                'F' => 'd7624b',
            ][$status],
        ];
    }
}
