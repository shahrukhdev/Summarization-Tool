<?php

namespace App\Repositories\AI;

use Illuminate\Support\Facades\Http;
use App\Interfaces\AIRepositoryInterface;

class GrokApiRepository implements AIRepositoryInterface
{
    public function summarize(string $text): array
    {
        try {
            $apiKey = config('services.xai.key');       // Grok 

            $model = 'grok-3';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.x.ai/v1/chat/completions', [
                "model" => $model, // or grok-1
                "messages" => [
                    [
                        "role" => "system",
                        "content" => "You are a helpful assistant that summarizes text concisely."
                    ],
                    [
                        "role" => "user",
                        "content" => $text
                    ]
                ],
                "max_tokens" => 300,
                "temperature" => 0.3
            ]);

            if ($response->failed()) {
                return [
                    'success' => false,
                    'data' => null,
                    'message' => '⚠️ API request failed.'
                ];
            }

            return [
                'success' => true,
                'data' => $response['choices'][0]['message']['content'] ?? '',
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