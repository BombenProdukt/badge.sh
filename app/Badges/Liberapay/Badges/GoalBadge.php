<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatPercentage;

final class GoalBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        $response = $this->client->get($username);

        if ($response['goal']) {
            $goalAmount = (float) $response['goal']['amount'];
            $receivesAmount = (float) $response['receiving']['amount'];
            $goal = \round(($receivesAmount / $goalAmount) * 100);
        }

        return [
            'goal' => $goal,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'goal progress',
            'message' => FormatPercentage::execute($properties['goal']),
            'messageColor' => isset($properties['goal']) ? 'yellow.600' : 'gray.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
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
