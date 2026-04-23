<div class="max-w-md mx-auto mt-10 bg-gray-50 rounded-3xl shadow-2xl overflow-hidden border border-gray-100">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white text-center">
        <h2 class="text-xl font-bold uppercase tracking-wider">{{ $weather['name'] }}</h2>
        <div class="flex justify-center items-center my-2">
            <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png" alt="Weather Icon"
                class="w-20">
            <span class="text-5xl font-extrabold">{{ round($weather['main']['temp']) }}°C</span>
        </div>
        <p class="text-blue-100 capitalize">{{ $weather['weather'][0]['description'] }}</p>
    </div>

    <div class="mt-6 px-4">
        <h3 class="text-lg font-bold mb-2">📍 أقرب ملعب متاح:</h3>
        <div id="map" class="rounded-2xl shadow-inner border-2 border-white" style="height: 300px; width: 100%;">
        </div>
    </div>

    <div class="p-6">
        <div class="flex items-center mb-4">
            <span class="flex h-3 w-3 mt-1 mr-2">
                <span
                    class="animate-ping absolute inline-flex h-3 w-3 rounded-full opacity-75 
                    {{ $result['color'] == 'green' ? 'bg-green-400' : ($result['color'] == 'red' ? 'bg-red-400' : 'bg-orange-400') }}"></span>
                <span
                    class="relative inline-flex rounded-full h-3 w-3 
                    {{ $result['color'] == 'green' ? 'bg-green-500' : ($result['color'] == 'red' ? 'bg-red-500' : 'bg-orange-500') }}"></span>
            </span>
            <h3 class="text-lg font-bold text-gray-800 ml-2">نصيحة الكوتش (AI):</h3>
        </div>

        <div
            class="bg-white p-4 rounded-xl border-l-4 
            {{ $result['color'] == 'green' ? 'border-green-500' : ($result['color'] == 'red' ? 'border-red-500' : 'border-orange-500') }} shadow-sm">
            <p class="text-gray-700 text-lg leading-relaxed font-medium italic">
                "{{ $result['message'] }}"
            </p>
        </div>

        <div class="mt-6">
            @if ($result['can_play'])
                <button
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition duration-300 shadow-lg">
                    حجز الملعب الآن ⚽
                </button>
            @else
                <button disabled class="w-full bg-gray-400 text-white font-bold py-3 rounded-xl cursor-not-allowed">
                    الجو غير مناسب للحجز ⛔
                </button>
            @endif
        </div>
    </div>

    <script>
        // 1. جلب الإحداثيات من Laravel (متغير $weather اللي صيفطنا من Controller)
        var lat = {{ $weather['coord']['lat'] }};
        var lon = {{ $weather['coord']['lon'] }};

        // 2. إنشاء الخريطة وتحديد المركز (Zoom 13 مناسب للمدن)
        var map = L.map('map').setView([lat, lon], 13);

        // 3. إضافة الطبقة الرسومية (Tiles) من OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // 4. إضافة Marker (علامة) فوق الموقع
        var marker = L.marker([lat, lon]).addTo(map);

        // 5. إضافة ميساج صغير ملي يكليكي المستعمل على العلامة
        marker.bindPopup("<b>ملعب القرب متوفر!</b><br>احجز ماتشك دابا.").openPopup();
    </script>
</div>
