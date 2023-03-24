<?php

declare(strict_types=1);

namespace App\Badges\Swagger\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/swagger/validator',
        ];
    }

    public function routeRules(): array
    {
        return [
            'spec' => ['required', 'url'],
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
            '/swagger/validator?spec=https://raw.githubusercontent.com/OAI/OpenAPI-Specification/master/examples/v2.0/json/petstore-expanded.json' => 'license',
        ];
    }
}
