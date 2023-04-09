<?php

declare(strict_types=1);

use Inertia\Inertia;
use App\Enums\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PreemStudio\Badger\Badger;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $badges = collect(app('badge.service')->all());

    if ($request->query('searchQuery')) {
        $badges = $badges->filter(function ($badge) use ($request) {
            $matchesService = \str_contains(\mb_strtolower($badge->service()), $request->query('searchQuery'));
            $matchesTitle = \str_contains(\mb_strtolower($badge->title()), $request->query('searchQuery'));
            $matchesKeyword = collect($badge->keywords())->contains(fn (BackedEnum $keyword) => \str_contains($keyword->value, $request->query('searchQuery')));

            return $matchesService || $matchesTitle || $matchesKeyword;
        });
    }

    if ($request->query('category') && $request->query('category') !== 'all') {
        $badges = $badges->filter(function ($badge) use ($request) {
            return collect($badge->keywords())->contains(fn (BackedEnum $keyword) => $keyword->value === $request->query('category'));
        });
    }

    return Inertia::render('Welcome', [
        'badges' => $badges->map(fn ($badge) => [
            'service' => $badge->service(),
            'previews' => collect($badge->previews())->map(function ($preview) {
                if ($preview->deprecated) {
                    $html = Badger::from([
                        'label' => $preview->name,
                        'message' => 'deprecated',
                        'messageColor' => 'red.600',
                    ])->render();
                } else {
                    $html = Badger::from($preview->data)->render();
                }

                return [
                    'hash' => Str::random(),
                    'name' => $preview->name,
                    'path' => $preview->path,
                    'html' => $html,
                ];
            }),
            'form' => [
                'pathPattern' => $badge->routeSchema()['path'],
                'path' => $badge->routeSchema()['path'],
                'query' => \array_fill_keys(\array_keys($badge->routeRules()), null),
                'route' => \array_fill_keys($badge->routeParameterKeys(), null),
                'overwrites' => [
                    'style' => 'flat',
                    'label' => null,
                    'labelColor' => null,
                    'message' => null,
                    'messageColor' => null,
                ]
            ],
        ]),
        'categories' => collect(Category::cases())->pluck('value')->map(fn ($category) => [
            'title' => Str::title($category),
            'value' => $category,
        ])
    ]);
})->middleware(CacheResponse::class);
