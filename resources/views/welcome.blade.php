<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased">
    <div class="lg:ml-72 xl:ml-80">
        <div class="relative px-4 pt-14 sm:px-6 lg:px-8">
            <main class="py-16">
                <article class="prose dark:prose-invert">
                    <div class="absolute inset-0 -z-10 mx-0 max-w-none overflow-hidden">
                        <div
                            class="absolute left-1/2 top-0 ml-[-38rem] h-[25rem] w-[81.25rem] dark:[mask-image:linear-gradient(white,transparent)]">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-[#36b49f] to-[#DBFF75] opacity-40 [mask-image:radial-gradient(farthest-side_at_top,white,transparent)] dark:from-[#36b49f]/30 dark:to-[#DBFF75]/30 dark:opacity-100">
                                <svg aria-hidden="true"
                                    class="absolute inset-x-0 inset-y-[-50%] h-[200%] w-full skew-y-[-18deg] fill-black/40 stroke-black/50 mix-blend-overlay dark:fill-white/2.5 dark:stroke-white/5">
                                    <defs>
                                        <pattern id=":R11d6:" width="72" height="56"
                                            patternUnits="userSpaceOnUse" x="-12" y="4">
                                            <path d="M.5 56V.5H72" fill="none"></path>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" stroke-width="0" fill="url(#:R11d6:)">
                                    </rect><svg x="-12" y="4" class="overflow-visible">
                                        <rect stroke-width="0" width="73" height="57" x="288"
                                            y="168"></rect>
                                        <rect stroke-width="0" width="73" height="57" x="144"
                                            y="56"></rect>
                                        <rect stroke-width="0" width="73" height="57" x="504"
                                            y="168"></rect>
                                        <rect stroke-width="0" width="73" height="57" x="720"
                                            y="336"></rect>
                                    </svg>
                                </svg>
                            </div><svg viewBox="0 0 1113 440" aria-hidden="true"
                                class="absolute top-0 left-1/2 ml-[-19rem] w-[69.5625rem] fill-white blur-[26px] dark:hidden">
                                <path d="M.016 439.5s-9.5-300 434-300S882.516 20 882.516 20V0h230.004v439.5H.016Z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <h1>Badgers</h1>
                    <p class="lead">Utilize the Badgers API to effectively communicate relevant status updates and
                        information to your devoted users through seamlessly rendered SVG badges.</p>

                    <div class="my-16 xl:max-w-none">
                        @foreach (\App\Providers\IntegrationServiceProvider::examples() as $group => $examples)
                            <div id="{{ Str::slug($group) }}">
                                <h2 id="{{ Str::slug($group) }}" class="scroll-mt-24">
                                    <a class="group text-inherit no-underline hover:text-inherit"
                                        href="/#{{ Str::slug($group) }}">
                                        <div
                                            class="absolute mt-1 ml-[calc(-1*var(--width))] hidden w-[var(--width)] opacity-0 transition [--width:calc(2.625rem+0.5px+50%-min(50%,calc(theme(maxWidth.lg)+theme(spacing.8))))] group-hover:opacity-100 group-focus:opacity-100 md:block lg:z-50 2xl:[--width:theme(spacing.10)]">
                                            <div
                                                class="group/anchor block h-5 w-5 rounded-lg bg-zinc-50 ring-1 ring-inset ring-zinc-300 transition hover:ring-zinc-500 dark:bg-zinc-800 dark:ring-zinc-700 dark:hover:bg-zinc-700 dark:hover:ring-zinc-600">
                                                <svg viewBox="0 0 20 20" fill="none" stroke-linecap="round"
                                                    aria-hidden="true"
                                                    class="h-5 w-5 stroke-zinc-500 transition dark:stroke-zinc-400 dark:group-hover/anchor:stroke-white">
                                                    <path
                                                        d="m6.5 11.5-.964-.964a3.535 3.535 0 1 1 5-5l.964.964m2 2 .964.964a3.536 3.536 0 0 1-5 5L8.5 13.5m0-5 3 3">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        {{ $group }}
                                    </a>
                                </h2>
                                <div
                                    class="not-prose grid grid-cols-1 gap-8 border-t border-zinc-900/5 pt-10 dark:border-white/5">
                                    <table class="table-fixed border-separate border-spacing-2">
                                        @foreach ($examples as $link => $label)
                                            <tr>
                                                <td>
                                                    <h3
                                                        class="text-sm text-right font-semibold text-zinc-900 dark:text-white">
                                                        {{ $label }}</h3>
                                                </td>
                                                <td><img src="{{ $link }}" /></td>
                                                <td>
                                                    <a class="inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition text-emerald-500 hover:text-emerald-600 dark:text-emerald-400 dark:hover:text-emerald-500"
                                                        href="{{ $link }}">
                                                        {{ $link }}
                                                        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true"
                                                            class="mt-0.5 h-5 w-5 relative top-px -mr-1">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="m11.5 6.5 3 3.5m0 0-3 3.5m3-3.5h-9"></path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </article>
            </main>
            <footer class="mx-auto max-w-2xl space-y-10 pb-16 lg:max-w-5xl">
                <div
                    class="flex flex-col items-center justify-between gap-5 border-t border-zinc-900/5 pt-8 dark:border-white/5 sm:flex-row">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400">&copy; Copyright {{ date('Y') }}. All
                        rights
                        reserved.</p>
                    <div class="flex gap-4"><a class="group" href="/#"><span class="sr-only">Follow us on
                                Twitter</span><svg viewBox="0 0 20 20" aria-hidden="true"
                                class="h-5 w-5 fill-zinc-700 transition group-hover:fill-zinc-900 dark:group-hover:fill-zinc-500">
                                <path
                                    d="M16.712 6.652c.01.146.01.29.01.436 0 4.449-3.267 9.579-9.242 9.579v-.003a8.963 8.963 0 0 1-4.98-1.509 6.379 6.379 0 0 0 4.807-1.396c-1.39-.027-2.608-.966-3.035-2.337.487.097.99.077 1.467-.059-1.514-.316-2.606-1.696-2.606-3.3v-.041c.45.26.956.404 1.475.42C3.18 7.454 2.74 5.486 3.602 3.947c1.65 2.104 4.083 3.382 6.695 3.517a3.446 3.446 0 0 1 .94-3.217 3.172 3.172 0 0 1 4.596.148 6.38 6.38 0 0 0 2.063-.817 3.357 3.357 0 0 1-1.428 1.861 6.283 6.283 0 0 0 1.865-.53 6.735 6.735 0 0 1-1.62 1.744Z">
                                </path>
                            </svg></a><a class="group" href="/#"><span class="sr-only">Follow us on
                                GitHub</span><svg viewBox="0 0 20 20" aria-hidden="true"
                                class="h-5 w-5 fill-zinc-700 transition group-hover:fill-zinc-900 dark:group-hover:fill-zinc-500">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10 1.667c-4.605 0-8.334 3.823-8.334 8.544 0 3.78 2.385 6.974 5.698 8.106.417.075.573-.182.573-.406 0-.203-.011-.875-.011-1.592-2.093.397-2.635-.522-2.802-1.002-.094-.246-.5-1.005-.854-1.207-.291-.16-.708-.556-.01-.567.656-.01 1.124.62 1.281.876.75 1.292 1.948.93 2.427.705.073-.555.291-.93.531-1.143-1.854-.213-3.791-.95-3.791-4.218 0-.929.322-1.698.854-2.296-.083-.214-.375-1.09.083-2.265 0 0 .698-.224 2.292.876a7.576 7.576 0 0 1 2.083-.288c.709 0 1.417.096 2.084.288 1.593-1.11 2.291-.875 2.291-.875.459 1.174.167 2.05.084 2.263.53.599.854 1.357.854 2.297 0 3.278-1.948 4.005-3.802 4.219.302.266.563.78.563 1.58 0 1.143-.011 2.061-.011 2.35 0 .224.156.491.573.405a8.365 8.365 0 0 0 4.11-3.116 8.707 8.707 0 0 0 1.567-4.99c0-4.721-3.73-8.545-8.334-8.545Z">
                                </path>
                            </svg></a></div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
