<?php

declare(strict_types=1);

namespace App\Integrations\XO\Controllers;

use App\Integrations\XO\Client;
use Illuminate\Routing\Controller;

final class IndentWithScopeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $scope, string $name): array
    {
        $response = $this->client->get("{$scope}/{$name}");

        if (empty($response['devDependencies']) || empty($response['devDependencies']['xo'])) {
            return [
                'label'       => 'xo',
                'status'      => 'not enabled',
                'statusColor' => 'gray.600',
            ];
        }

        return [
            'label'       => 'xo',
            'status'      => $this->getIndent($response['xo']['space'] ?? false),
            'statusColor' => '5ed9c7',
        ];
    }

    private function getIndent(int $space): string
    {
        if ($space === false) {
            return 'tab';
        }

        if ($space === true) {
            return '2 spaces';
        }

        if ($space === 1) {
            return '1 space';
        }

        return "{$space} spaces";
    }
}
