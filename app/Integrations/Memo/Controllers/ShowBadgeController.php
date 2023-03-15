<?php

declare(strict_types=1);

namespace App\Integrations\Memo\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

final class ShowBadgeController extends Controller
{
    public function __invoke(string $name): array
    {
        return Cache::get($name);
    }
}
