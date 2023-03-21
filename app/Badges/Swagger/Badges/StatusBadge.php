<?php

declare(strict_types=1);

namespace App\Badges\Swagger\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Swagger\Client;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(): array
    {
        $schemaValidationMessages = $this->client->debug($this->getRequestData('spec'));

        if (empty($schemaValidationMessages)) {
            return $this->renderStatus($this->service(), 'passed');
        }

        return $this->renderStatus($this->service(), 'failed');
    }

    public function service(): string
    {
        return 'Swagger';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
