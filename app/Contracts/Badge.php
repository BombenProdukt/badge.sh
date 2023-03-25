<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Routing\Route;

/**
 * @method array handle()
 * @method void  setRequest()
 * @method void  setRequestData()
 */
interface Badge
{
    /**
     * @param array<string,mixed> $properties
     */
    public function render(array $properties): array;

    public function service(): string;

    public function title(): string;

    public function keywords(): array;

    public function routePaths(): array;

    public function routeRules(): array;

    public function routeConstraints(Route $route): void;

    public function previews(): array;

    public function deprecated(): array;
}
