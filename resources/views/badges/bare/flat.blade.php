<svg width="{{ ($scale * $stRectWidth) / 10 }}" height="{{ $scale * 20 }}" viewBox="0 0 {{ $stRectWidth }} 200"
    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="{{ $status }}">
    <title>{{ $status }}</title>
    <g>
        <rect fill="#{{ $statusColor }}" x="0" width="{{ $stRectWidth }}" height="200" />
    </g>
    <g aria-hidden="true" fill="#fff" text-anchor="start" font-family="Verdana,DejaVu Sans,sans-serif"
        font-size="110">
        <text x="65" y="148" textLength="{{ $stTextWidth }}" fill="#000"
            opacity="0.1">{{ $status }}</text>
        <text x="55" y="138" textLength="{{ $stTextWidth }}">{{ $status }}</text>
    </g>
</svg>
