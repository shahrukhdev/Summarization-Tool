<?php

namespace App\Repositories\AI;

use Illuminate\Support\Facades\Http;
use App\Interfaces\AIRepositoryInterface;

class OpenAIChatApiRepository implements AIRepositoryInterface
{
    public function summarize(string $text): array
    {
        try {

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'user', 'content' => "Summarize this:\n".$text],
                ],
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