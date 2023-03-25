<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class WheelBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/pypi/wheel/{project}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $project): array
    {
        $urls = $this->client->get($project)['urls'];
        $hasWheel = false;
        $hasEgg = false;

        foreach ($urls as $url) {
            $packageType = $url['packagetype'];

            if (\in_array($packageType, ['wheel', 'bdist_wheel'], true)) {
                $hasWheel = true;
            }

            if (\in_array($packageType, ['egg', 'bdist_egg'], true)) {
                $hasEgg = true;
            }
        }

        return [
            'hasWheel' => $hasWheel,
            'hasEgg' => $hasEgg,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'wheel',
            'message' => $properties['hasWheel'] ? 'yes' : 'no',
            'messageColor' => $properties['hasWheel'] ? 'green.600' : 'red.600',
        ];
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
            '/pypi/wheel/black' => 'wheel',
        ];
    }
}
