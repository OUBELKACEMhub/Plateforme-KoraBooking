<svg {{ $attributes->merge(['class' => 'w-full h-auto']) }} viewBox="0 0 300 100" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <style>
            .c1-k {
                font-family: 'Montserrat', sans-serif;
                font-weight: 900;
                font-size: 38px;
                fill: #111111;
            }

            .c1-b {
                font-family: 'Poppins', sans-serif;
                font-weight: 600;
                font-size: 14px;
                fill: #FF6B00;
                letter-spacing: 5px;
            }
        </style>
    </defs>
    <!-- Map Pin -->
    <path d="M 45 10 C 25.67 10 10 25.67 10 45 C 10 75 45 95 45 95 C 45 95 80 75 80 45 C 80 25.67 64.33 10 45 10 Z"
        fill="#FF6B00"></path>
    <!-- Inner Ball -->
    <circle cx="45" cy="42" r="18" fill="#FFFFFF"></circle>
    <!-- Hexagon -->
    <path d="M 45 31 L 54.5 38 L 50.8 49.5 L 39.2 49.5 L 35.5 38 Z" fill="#111111"></path>
    <!-- Lines from Hexagon -->
    <path d="M 45 31 L 45 24 M 54.5 38 L 61.5 36 M 50.8 49.5 L 54.5 56 M 39.2 49.5 L 35.5 56 M 35.5 38 L 28.5 36"
        stroke="#111111" stroke-width="2.5" stroke-linecap="round"></path>
    <!-- Text -->
    <text x="100" y="55" class="c1-k">KOORA</text>
    <text x="103" y="75" class="c1-b">BOOKING</text>
</svg>
