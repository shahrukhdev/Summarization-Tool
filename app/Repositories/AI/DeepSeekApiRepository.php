<?php

namespace App\Repositories\AI;

use Illuminate\Support\Facades\Http;
use App\Interfaces\AIRepositoryInterface;

class DeepSeekApiRepository implements AIRepositoryInterface
{
    public function summarize(string $text): array
    {
        try {
            $apiKey = config('services.deepseek.key');

            $model = 'deepseek-chat';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.deepseek.com/v1/chat/completions', [
                "model" => $model,
                "messages" => [
                    [
                        "role" => "system",
                        "content" => "You are a helpful assistant that summarizes text concisely."
                    ],
                    [
                        "role" => "user",
                        "content" => "Summarize this:\n\n" . $text
                    ]
                ],
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