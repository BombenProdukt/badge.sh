<svg width="{{ ($scale * $stRectWidth) / 10 }}" height="{{ $scale * 20 }}" viewBox="0 0 {{ $stRectWidth }} 200"
    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="{{ $message }}">
    <title>{{ $message }}</title>
    <g>
        <rect fill="{{ $messageColor }}" x="0" width="{{ $stRectWidth }}" height="200" />
    </g>
    <g aria-hidden="true" fill="#fff" text-anchor="start" font-family="Verdana,Geneva,DejaVu Sans,sans-serif"
        font-size="110">
        <text x="65" y="148" textLength="{{ $stTextWidth }}" fill="#000"
            opacity="0.1">{{ $message }}</text>
        <text x="55" y="138" textLength="{{ $stTextWidth }}">{{ $message }}</text>
    </g>
</svg>
