<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Routing\Route;

/**
 * @method array handle()
 */
interface Badge
{
    public function service(): string;

    public function title(): string;

    public function keywords(): array;

    public function routePaths(): array;

    public function routeParameters(): array;

    public function routeConstraints(Route $route): void;

    public function staticPreviews(): array;

    public function dynamicPreviews(): array;

    public function deprecated(): array;
}
