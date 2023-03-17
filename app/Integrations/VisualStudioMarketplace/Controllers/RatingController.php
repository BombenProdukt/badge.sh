<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\VisualStudioMarketplace\Client;

final class RatingController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $extension): array
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
