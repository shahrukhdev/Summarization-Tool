<?php

namespace App\Services\AI;

use App\Interfaces\AIServiceInterface;
use App\Interfaces\AIRepositoryInterface;

class AIService implements AIServiceInterface
{
    public function summarize(string $key, string $text): array
    {
        $repository = $this->resolveRepository($key);

        return $repository->summarize($text);
    }

    private function resolveRepository(string $key): AIRepositoryInterface
    {
        return match($key) {
            'openai_package' => new \App\Repositories\AI\OpenAIPackageRepository(),
            'openai_chat_api' => new \App\Repositories\AI\OpenAIChatApiRepository(),
            'openai_response_api' => new \App\Repositories\AI\OpenAIResponseApiRepository(),
            'gemini_api' => new \App\Repositories\AI\GeminiApiRepository(),
            'deepseek_chat_api' => new \App\Repositories\AI\DeepSeekApiRepository(),
            'claude_chat_api' => new \App\Repositories\AI\AnthropicClaudeApiRepository(),
            'grok_chat_api' => new \App\Repositories\AI\GrokApiRepository(),
            default => throw new \Exception('Unsupported model')
        };
    }
}