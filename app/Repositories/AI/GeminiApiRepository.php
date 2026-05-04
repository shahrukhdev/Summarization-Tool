<?php

namespace App\Repositories\AI;

use Illuminate\Support\Facades\Http;
use App\Interfaces\AIRepositoryInterface;

class GeminiApiRepository implements AIRepositoryInterface
{
    public function summarize(string $text): array
    {
        try {
            $apiKey = config('services.gemini.key');

            $model = 'gemini-2.5-flash';

            $response = Http::post(
                "https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent?key={$apiKey}",
                [
                    "contents" => [
                        [
                            "parts" => [
                                ["text" => "Summarize the following text:\n\n" . $text]
                            ]
                        ]
                    ]
                ]
            );

            if ($response->failed()) {
                return [
                    'success' => false,
                    'data' => null,
                    'message' => '⚠️ API request failed.'
                ];
            }

            return [
                'success' => true,
                'data' => $response['candidates'][0]['content']['parts'][0]['text'] ?? '',
                'message' => null
            ];

        } catch (\Exception $e) {

            \Log::error($e->getMessage());

            return [
                'success' => false,
                'data' => null,
                'message' => '⚠️ Service unavailable.'
            ];
        }
    }
}