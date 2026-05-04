<?php

namespace App\Repositories\AI;

use Illuminate\Support\Facades\Http;
use App\Interfaces\AIRepositoryInterface;

class OpenAIResponseApiRepository implements AIRepositoryInterface
{
    public function summarize(string $text): array
    {
        try {

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
            ])->post('https://api.openai.com/v1/responses', [
                'model' => 'gpt-4o-mini',
                'input' => "Summarize this:\n".$text,
            ]);

            if ($response->failed()) {
                return [
                    'success' => false,
                    'data' => null,
                    'message' => '⚠️ API request failed.'
                ];
            }

            $data = $response->json();

            return [
                'success' => true,
                'data' => $data['output'][0]['content'][0]['text'] ?? '',
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