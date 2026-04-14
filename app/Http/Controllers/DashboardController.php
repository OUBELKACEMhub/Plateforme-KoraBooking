<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    

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