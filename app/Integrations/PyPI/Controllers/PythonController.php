<?php

declare(strict_types=1);

namespace App\Integrations\PyPI\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\PyPI\Client;

final class PythonController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $project): array
    {
        $versions = collect($this->client->get($project)['classifiers'])
            ->map(function (string $classifier) {
                preg_match('/^Programming Language :: Python :: ([\d.]+)( :: Only)?$/i', $classifier, $matches);

                if (empty($matches)) {
                    return [];
                }

                return [
                    'version'     => $matches[1],
                    'isExclusive' => isset($matches[2]),
                ];
            })
            ->filter()
            ->unique(fn (array $item) => $item['version'])
            ->implode('version', ' | ');

        return [
            'label'       => 'python',
            'status'      => $versions,
            'statusColor' => 'blue.600',
        ];
    }
}
