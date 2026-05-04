<?php

namespace App\Repositories\AI;

use Illuminate\Support\Facades\Http;
use App\Interfaces\AIRepositoryInterface;

class AnthropicClaudeApiRepository implements AIRepositoryInterface
{
    public function summarize(string $text): array
    {
        try {
            $apiKey = config('services.claude.key');

            $model = 'claude-3-haiku-20240307';         // fast + cheap

            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'content-type' => 'application/json',
            ])->post($this->baseUrl, [
                "model" => $model, 
                "max_tokens" => 300,
                "messages" => [
                    [
                        "role" => "user",
                        "content" => "Summarize the following text in a concise paragraph:\n\n" . $text
                    ]
                ]
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
                'data' => $response['content'][0]['text'] ?? '',
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