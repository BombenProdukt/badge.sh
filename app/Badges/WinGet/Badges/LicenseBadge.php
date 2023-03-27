<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Symfony\Component\Yaml\Yaml;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/winget/license/{appId}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $appId): array
    {
        $document = Yaml::parse(\base64_decode($this->client->get($appId)['content'], true));
        $document = Yaml::parse(\base64_decode($this->client->locale($appId, $document['PackageVersion'], $document['DefaultLocale'])['content'], true));

        return [
            'license' => $document['License'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/winget/license/GitHub.cli',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
