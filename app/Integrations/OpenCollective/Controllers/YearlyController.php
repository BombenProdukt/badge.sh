<?php

declare(strict_types=1);

namespace App\Integrations\OpenCollective\Controllers;

use App\Integrations\Actions\FormatMoney;
use App\Integrations\OpenCollective\Client;
use Illuminate\Routing\Controller;

final class YearlyController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'yearly income',
            'status'      => FormatMoney::execute($response['yearlyIncome'] / 100, $response['currency']),
            'statusColor' => 'green.600',
        ];
    }
}
