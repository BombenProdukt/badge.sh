<?php

declare(strict_types=1);

namespace App\Integrations\Memo\Controllers;

use App\Integrations\AbstractController;
use Illuminate\Support\Facades\Cache;

final class ShowBadgeController extends AbstractController
{
    protected function handleRequest(string $name): array
    {
        return Cache::get($name);
    }
}
