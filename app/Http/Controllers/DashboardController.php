<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stadiums = Stadium::query()
            ->when($request->city, function ($query, $city) {
                return $query->where('city', 'like', "%{$city}%");
            })
            ->when($request->max_price, function ($query, $maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })
            ->get(); 

        $today = Carbon::today();
        
        $offers = Offer::with('stadiums')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->orderBy('created_at', 'desc') 
            ->take(8) 
            ->get();

        $weatherCity = $request->city ? $request->city : 'Safi';
        $weatherKey = config('services.openweather.key');
        $weatherResp = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $weatherCity,
            'appid' => $weatherKey,
            'units' => 'metric',
            'lang' => 'fr'
        ]);
        
        $weather = $weatherResp->successful() ? $weatherResp->json() : null;
        
        $ai = $this->getAiCoachAdvice($weather, $weatherCity);

        
        return view('dashboard', compact('stadiums', 'weather', 'ai', 'offers'));
    }


    public function aide(){
         return view('aide');
    }


    public function show($id)
    {
        $stadium = Stadium::findOrFail($id);
        
        $city = $stadium->city;
        $weatherKey = config('services.openweather.key');
        
        $weatherResp = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $weatherKey,
            'units' => 'metric',
            'lang' => 'fr'
        ]);
        
        $weather = $weatherResp->successful() ? $weatherResp->json() : null;       
        $ai = $this->getAiCoachAdvice($weather, $city); 
        return view('stadiums.show', compact('stadium', 'weather', 'ai'));
    }

    private function getAiCoachAdvice($weather, $city)
    {
        if (!$weather) {
            return [
                'can_play' => true,
                'message' => "Coach indisponible.",
                'color' => 'orange'
            ];
        }

        $temp = $weather['main']['temp'];
        $desc = $weather['weather'][0]['description'];
        
        $windMs = isset($weather['wind']['speed']) ? $weather['wind']['speed'] : 0;
        $windKmh = round($windMs * 3.6); 
        
        

        $apiKey = config('services.gemini.key');

        $prompt = "Météo à $city : {$temp}°C, $desc, vent à {$windKmh} km/h. 
                   Peut-on jouer au foot à 5 en extérieur ? Réponds en FRANÇAIS. 
                   CONSIGNE STRICTE : Le 'message' doit être TRÈS COURT (maximum 10 mots). 
                   RÈGLE VITALE : Si le vent dépasse 40 km/h ou la température est < 5°C, tu DOIS interdire de jouer.
                   Retourne UNIQUEMENT du JSON exact sous ce format : {\"can_play\": bool, \"message\": \"phrase courte\", \"color\": \"green\" ou \"orange\" ou \"red\"}";

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        try {
            $aiResponse = \Illuminate\Support\Facades\Http::withOptions([
                'verify' => false 
            ])->post($url, [
                'contents' => [['parts' => [['text' => $prompt]]]],
                'generationConfig' => ['temperature' => 0.7]
            ]);

            $result = null;

            if ($aiResponse->successful()) {
                $rawText = $aiResponse->json()['candidates'][0]['content']['parts'][0]['text'];
                $cleanJson = preg_replace('/```json|```/', '', $rawText);
                $result = json_decode(trim($cleanJson), true);
            }

            if (!$result || !isset($result['message'])) {
                $result = [
                    'can_play' => ($temp > 5 && $windKmh < 40),
                    'message' => "Vent: {$windKmh}km/h. Bon match !",
                    'color' => 'green'
                ];
            }

            return $result;

        } catch (\Exception $e) {
            return [
                'can_play' => true,
                'message' => "Prêt pour le match !",
                'color' => 'green'
            ];
        }
    }
    }