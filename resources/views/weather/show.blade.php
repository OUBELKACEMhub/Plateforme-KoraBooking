<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">الطقس في {{ $data['name'] }}</h2>

    <div class="flex items-center">
        <img src="http://openweathermap.org/img/wn/{{ $data['weather'][0]['icon'] }}@2x.png" alt="icon">
        <span class="text-4xl">{{ $data['main']['temp'] }}°C</span>
    </div>

    <p class="mt-2 text-gray-600">
        الحالة: {{ $data['weather'][0]['description'] }}
    </p>
    <p>الرطوبة: {{ $data['main']['humidity'] }}%</p>
</div>
