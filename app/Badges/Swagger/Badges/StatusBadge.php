<?php

declare(strict_types=1);

namespace App\Badges\Swagger\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/swagger/validator',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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
