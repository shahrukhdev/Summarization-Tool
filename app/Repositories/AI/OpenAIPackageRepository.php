<?php

namespace App\Repositories\AI;
 
use OpenAI\Laravel\Facades\OpenAI;
use App\Interfaces\AIRepositoryInterface; 
use OpenAI\Exceptions\RateLimitException;

class OpenAIPackageRepository implements AIRepositoryInterface
{
    public function summarize(string $text): array
    {
        try {

            $response = OpenAI::chat()->create([
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'user', 'content' => "Summarize this:\n".$text],
                    ],
                ]);

            return [
                'success' => true,
                'data' => $response->choices[0]->message->content ?? '',
                'message' => null
            ];

        } catch (RateLimitException $e) {

            return [
                'success' => false,
                'data' => null,
                'message' => '⚠️ Too many requests. Please try again in a few seconds.'
            ];

        } catch (\Exception $e) {

            \Log::error($e->getMessage());

            return [
                'success' => false,
                'data' => null,
                'message' => '⚠️ AI service is temporarily unavailable.'
            ];
        }
    }
}