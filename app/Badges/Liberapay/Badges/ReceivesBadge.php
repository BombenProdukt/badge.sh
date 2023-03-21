<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Liberapay\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatMoney;

final class ReceivesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'        => 'receives',
            'message'      => FormatMoney::execute((float) $response['receiving']['amount'], $response['receiving']['currency']).'/week',
            'messageColor' => 'yellow.600',
        ];
    }

    public function service(): string
    {
        return 'Liberapay';
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
    }

    public function routePaths(): array
    {
        return [
            '/liberapay/receives/{username}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/liberapay/receives/GIMP' => 'receiving',
        ];
    }
}
