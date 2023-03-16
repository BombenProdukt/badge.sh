<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use BladeUI\Icons\Factory;
use Closure;
use Iconify\IconsJSON\Finder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use PreemStudio\Badger\Badger;
use Symfony\Component\HttpFoundation\Response;

final class RenderBadgeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // /**
        //  * This incurs a performance penalty, but it's the only way to
        //  * ensure that the response is a badge response because of the
        //  * spatie/laravel-responsecache middlewares hooking into this.
        //  *
        //  * This is a temporary solution until I can figure out a better
        //  * way of doing this but until then this will do the job and we
        //  * still get the benefit of skipping the requests to the remote.
        //  */
        // if ($response instanceof HttpResponse) {
        //     return response(
        //         Badger::from(json_decode($response->getContent(), true))
        //             ->withStyle($request->query('style', 'flat'))
        //             ->render()
        //     );
        // }

        if ($response instanceof JsonResponse) {
            $badge = Badger::from($response->getOriginalContent());
            $badge->withStyle($request->query('style', 'flat'));

            if ($request->has('hideLabel')) {
                $badge->withLabel('');
            }

            if ($request->has('icon')) {
                $icon = $request->query('icon');

                if (str_starts_with($icon, 'heroicon')) {
                    $icon = app(Factory::class)->svg($icon)->contents();
                    $icon = str_replace('stroke="currentColor"', 'stroke="#fff"', $icon);
                    $icon = base64_encode($icon);
                }

                if (str_starts_with($icon, 'iconify')) {
                    [,$set,$name] = explode('-', $icon, 3);

                    $icon = json_decode(file_get_contents(Finder::locate($set)), true, JSON_THROW_ON_ERROR)['icons'][$name]['body'];
                    $icon = str_replace('fill="currentColor"', 'fill="#fff"', $icon);
                    $icon = base64_encode('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">'.$icon.'</svg>');
                }

                $badge->withIcon('data:image/svg+xml;base64,'.$icon);
            }

            return response($badge->render())->header('Content-Type', 'image/svg+xml;charset=utf-8');
        }

        return $response;
    }
}
