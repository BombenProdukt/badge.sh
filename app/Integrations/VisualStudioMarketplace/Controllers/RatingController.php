<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace\Controllers;

use App\Integrations\VisualStudioMarketplace\Client;
use Illuminate\Routing\Controller;

final class RatingController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $extension): array
    {
        $response      = collect($this->client->get($extension));
        $averageRating = collect($response['statistics'])->firstWhere('statisticName', 'averagerating')['value'];
        $ratingCount   = collect($response['statistics'])->firstWhere('statisticName', 'ratingcount')['value'];

        return [
            'label'        => 'rating',
            'status'       => number_format($averageRating)."/5 ({$ratingCount})",
            'statusColor'  => 'green.600',
        ];
    }
}
