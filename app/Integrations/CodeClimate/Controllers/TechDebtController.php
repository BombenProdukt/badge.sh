<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\CodeClimate\Client;
use Illuminate\Routing\Controller;

final class TechDebtController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');
        $ratio    = $response['meta']['measures']['technical_debt_ratio']['value'];

        return [
            'label'       => 'technical debt',
            'status'      => FormatNumber::execute($ratio),
            'statusColor' => match (true) {
                $ratio <= 5  => 'green.600' ,
                $ratio <= 10 => '9C1' ,
                $ratio <= 20 => 'AA2' ,
                $ratio <= 50 => 'DC2' ,
                default      => 'orange.600',
            },
        ];
    }
}
