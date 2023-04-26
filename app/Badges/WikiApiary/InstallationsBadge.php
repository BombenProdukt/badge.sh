<?php

declare(strict_types=1);

namespace App\Badges\WikiApiary;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class InstallationsBadge extends AbstractBadge
{
    protected string $route = '/wikiapiary/installations/{variant:extension,skin,farm,generator,host}/{name}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $variant, string $name): array
    {
        $results = $this->client->usage($variant, $name);
        $resultKey = \array_search("{$variant}:{$name}", \array_map('strtolower', \array_keys($results)), true);

        return [
            'count' => $results[$resultKey]['printouts']['Has website count'][0],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('installations', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'installations',
                path: '/wikiapiary/installations/extension/ParserFunctions',
                data: $this->render(['count' => '1000000']),
            ),
        ];
    }
}
