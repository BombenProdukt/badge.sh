<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Liberapay\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatPercentage;

final class GoalBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $response = $this->client->get($username);

        if ($response['goal']) {
            $goalAmount     = floatval($response['goal']['amount']);
            $receivesAmount = floatval($response['receiving']['amount']);
            $goal           = round(($receivesAmount / $goalAmount) * 100);
        }

        return [
            'label'        => 'goal progress',
            'message'      => FormatPercentage::execute($goal),
            'messageColor' => isset($goal) ? 'yellow.600' : 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'Liberapay';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/liberapay/goal/{username}',
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
            '/liberapay/goal/Changaco' => 'goal progress',
        ];
    }
}
