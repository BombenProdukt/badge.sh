<?php

declare(strict_types=1);

namespace App\Badges\Swagger\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/swagger/validator',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(): array
    {
        $schemaValidationMessages = $this->client->debug($this->getRequestData('spec'));

        if (empty($schemaValidationMessages)) {
            return [
                'status' => 'passed',
            ];
        }

        return [
            'status' => 'failed',
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus($this->service(), $properties['status']);
    }

    public function routeRules(): array
    {
        return [
            'spec' => ['required', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/swagger/validator?spec=https://raw.githubusercontent.com/OAI/OpenAPI-Specification/master/examples/v2.0/json/petstore-expanded.json',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
