<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class WheelBadge extends AbstractBadge
{
    protected array $routes = [
        '/pypi/wheel/{project}',
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'wheel',
                path: '/pypi/wheel/black',
                data: $this->render(['hasWheel' => true]),
            ),
            new BadgePreviewData(
                name: 'wheel',
                path: '/pypi/wheel/black',
                data: $this->render(['hasWheel' => false]),
            ),
        ];
    }
}
