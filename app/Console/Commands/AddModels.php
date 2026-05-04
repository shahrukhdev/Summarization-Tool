<?php

namespace App\Console\Commands;

use App\Models\AIModel;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('app:add-models')]
#[Description('To add models.')]
class AddModels extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $aiModels = [

            [
                'category_id' => 1,
                'key' => 'openai_package',
                'name' => 'OpenAI Package',
                'description' => 'Laravel Package Implementation',
                'type' => 'package'
            ],

            [
                'category_id' => 1,
                'key' => 'openai_api_old',
                'name' => 'OpenAI Chat API',
                'description' => 'Old Chat Completions API',
                'type' => 'api'
            ],

            [
                'category_id' => 1,
                'key' => 'openai_api_new',
                'name' => 'OpenAI Responses API',
                'description' => 'Latest Responses API',
                'type' => 'responses'
            ],

            [
                'category_id' => 2,
                'key' => 'gemini_api',
                'name' => 'Gemini API',
                'description' => 'Gemini Content Generation API',
                'type' => 'api'
            ],

            [
                'category_id' => 3,
                'key' => 'deepseek_chat_api',
                'name' => 'DeepSeek Chat API',
                'description' => 'Chat Completions API',
                'type' => 'api'
            ],

            [
                'category_id' => 4,
                'key' => 'claude_chat_api',
                'name' => 'Claude Chat API',
                'description' => 'Chat Completions API',
                'type' => 'api'
            ],

        ];    

        if(count($aiModels)) {

            foreach($aiModels as $aiModel)
            {
                $record = AIModel::firstOrCreate([
                    'category_id' => $aiModel['category_id'],
                    'key' => $aiModel['key'] ?? '',
                    'name' => $aiModel['name'] ?? '',
                    'slug' => Str::slug($aiModel['name']) ?? '',
                    'description' => $aiModel['description'] ?? '',
                    'type' => $aiModel['type'] ?? '',
                    'is_active' => 1
                ]);

                $this->info($record->name . ' model added.');

            }

        }

    }
}
