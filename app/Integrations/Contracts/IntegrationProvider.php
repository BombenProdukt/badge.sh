<?php

declare(strict_types=1);

namespace App\Integrations\Contracts;

interface IntegrationProvider
{
    public function name(): string;

    public function register(): void;

    // public function examples(): array;
}
