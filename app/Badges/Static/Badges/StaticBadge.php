<?php

declare(strict_types=1);

namespace App\Badges\Static\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StaticBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/static/{label}/{message}/{messageColor?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $label, string $message, ?string $messageColor = 'green.600'): array
    {
        return [
            'label' => $label,
            'message' => $message,
            'messageColor' => $messageColor,
        ];
    }

    public function render(array $properties): array
    {
        return $properties;
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
            '/static/Swift/4.2/orange' => 'swift version',
            '/static/license/MIT/blue' => 'license MIT',
            '/static/chat/on%20gitter/cyan' => 'chat on gitter',
            '/static/stars/★★★★☆' => 'star rating',
            '/static/become/a%20patron/F96854' => 'patron',
            '/static/code%20style/standard/f2a' => 'code style: standard',
        ];
    }
}
