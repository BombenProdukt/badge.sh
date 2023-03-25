<?php

declare(strict_types=1);

namespace App\Badges\Concerns;

use Illuminate\Routing\Route;

trait HasRoute
{
    public function routePaths(): array
    {
        return $this->routes ?? [];
    }

    public function routeRules(): array
    {
        return [];
    }

    public function routeParameters(): array
    {
        return $this->request->route()->parameterNames();
    }

    public function allowedParameters(): array
    {
        return [
            'query' => \array_keys($this->routeRules()),
            'route' => $this->request->route()->parameterNames(),
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }
}
