<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatPercentage;

final class GoalBadge extends AbstractBadge
{
    protected array $routes = [
        '/liberapay/goal/{username}',
    ];

    protected array $keywords = [
        Category::FUNDING,
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'goal progress',
                path: '/liberapay/goal/Changaco',
                data: $this->render(['goal' => 50]),
            ),
        ];
    }
}
