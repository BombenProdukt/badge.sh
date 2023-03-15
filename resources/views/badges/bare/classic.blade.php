<svg width="{{ ($scale * $stRectWidth) / 10 }}" height="{{ $scale * 20 }}" viewBox="0 0 {{ $stRectWidth }} 200"
    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="{{ $status }}">
    <title>{{ $status }}</title>
    <linearGradient id="a" x2="0" y2="100%">
        <stop offset="0" stop-opacity=".1" stop-color="#EEE" />
        <stop offset="1" stop-opacity=".1" />
    </linearGradient>
    <mask id="m">
        <rect width="{{ $stRectWidth }}" height="200" rx="30" fill="#FFF" />
    </mask>
    <g mask="url(#m)">
        <rect width="{{ $stRectWidth }}" height="200" fill="#{{ $statusColor }}" x="0" />
        <rect width="{{ $stRectWidth }}" height="200" fill="url(#a)" />
    </g>
    <g aria-hidden="true" fill="#fff" text-anchor="start" font-family="Verdana,DejaVu Sans,sans-serif"
        font-size="110">
        <text x="65" y="148" textLength="{{ $stTextWidth }}" fill="#000"
            opacity="0.25">{{ $status }}</text>
        <text x="55" y="138" textLength="{{ $stTextWidth }}">{{ $status }}</text>
    </g>
</svg>
