<?php

declare(strict_types=1);

namespace App\Integrations\ChromeWebStore\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\ChromeWebStore\Client;
use Illuminate\Routing\Controller;

final class UsersController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $itemId): array
    {
        preg_match('|<span class="e-f-ih" title="(.*?)">(.*?)</span>|', $this->client->get($itemId), $matches);

        return [
            'label'       => 'rating',
            'status'      => FormatNumber::execute((int) filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT)),
            'statusColor' => 'green.600',
        ];
    }
}
