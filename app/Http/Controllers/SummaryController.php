<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Exceptions\RateLimitException;
use OpenAI\Exceptions\ErrorException;

class SummaryController extends Controller
{
    // PACKAGE FORM
    public function packageForm()
    {
        return view('summary.package');
    }

    // API FORM
    public function apiForm()
    {
        return view('summary.api');
    }

    // USING LARAVEL PACKAGE
    public function packageSummary(Request $request)
    {
        $request->validate([
            'text' => 'required|string'
        ]);

        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'user', 'content' => "Summarize this:\n" . $request->text],
                ],
            ]);

            // For better control
            // $response = OpenAI::chat()->create([
            //     'model' => 'gpt-4o-mini',
            //     'messages' => [
            //         [
            //             'role' => 'system',
            //             'content' => 'You are an expert text summarizer. Summarize user text concisely.'
            //         ],
            //         [
            //             'role' => 'user',
            //             'content' => $request->text
            //         ],
            //     ],
            // ]);

            $summary = $response->choices[0]->message->content ?? 'No summary returned.';

            return response()->json([
                'success' => true,
                'summary' => $summary
            ]);

        } catch (RateLimitException $e) {
            // Handle API rate limit errors
            return response()->json([
                'success' => false,
                'summary' => '⚠️ Rate limit exceeded. Please wait a few seconds and try again.'
            ], 429);

        } catch (ErrorException $e) {
            // General OpenAI API error
            return response()->json([
                'success' => false,
                'summary' => '⚠️ OpenAI API error: ' . $e->getMessage()
            ], 500);

        } catch (\Exception $e) {
            // Catch-all for unexpected errors
            return response()->json([
                'success' => false,
                'summary' => '⚠️ Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    // USING RAW API
    public function apiSummary(Request $request)
    {
        $request->validate([
            'text' => 'required|string'
        ]);

        try {
            // Old API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'user', 'content' => "Summarize this:\n" . $request->text],
                ],
            ]);

            // NEW API
            // $response = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            //     'Content-Type' => 'application/json',
            // ])->post('https://api.openai.com/v1/chat/responses', [
            //     'model' => 'gpt-4o-mini',
            //     'messages' => [
            //         ['role' => 'user', 'content' => "Summarize this:\n" . $request->text],
            //     ],
            // ]);

            // Check for HTTP errors
            if ($response->failed()) {
                // Handle rate limit (429) separately
                if ($response->status() === 429) {
                    return response()->json([
                        'success' => false,
                        'summary' => '⚠️ Rate limit exceeded. Please wait a few seconds and try again.'
                    ], 429);
                }

                return response()->json([
                    'success' => false,
                    'summary' => '⚠️ OpenAI API error: ' . $response->body()
                ], $response->status());
            }

            // Extract summary safely

            // Old API Response
            $summary = $response['choices'][0]['message']['content'] ?? 'No summary returned.';

            // New API Response
            // $summary = $data['output'][0]['content'][0]['text'] ?? 'No summary returned.';

            return response()->json([
                'success' => true,
                'summary' => $summary
            ]);

        } catch (\Exception $e) {
            // Catch all unexpected errors
            return response()->json([
                'success' => false,
                'summary' => '⚠️ Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }
}
