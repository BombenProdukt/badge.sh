<?php

declare(strict_types=1);

namespace App\Badges\PyPI;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FormatBadge extends AbstractBadge
{
    protected string $route = '/pypi/format/{project}';

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
        if ($properties['hasWheel']) {
            return $this->renderText('format', 'wheel', 'green.600');
        }

        if ($properties['hasEgg']) {
            return $this->renderText('format', 'egg', 'red.600');
        }

        return $this->renderText('format', 'source', 'yellow.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'format',
                path: '/pypi/format/black',
                data: $this->render(['hasWheel' => true, 'hasEgg' => false]),
            ),
            new BadgePreviewData(
                name: 'format',
                path: '/pypi/format/black',
                data: $this->render(['hasWheel' => false, 'hasEgg' => true]),
            ),
        ];
    }
}
