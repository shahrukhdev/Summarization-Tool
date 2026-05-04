<?php

namespace App\Http\Controllers;

use App\Interfaces\AIServiceInterface;
use App\Models\AiModel;
use App\Models\Category;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    protected $aiService;

    public function __construct(AIServiceInterface $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index()
    {
        $categories = Category::with(['models' => function ($query) {
            $query->active();
        }])->get();

        return view('models.index', compact('categories'));
    }

    public function show($slug)
    {
        $model = AiModel::where('slug', $slug)->firstOrFail();

        return view('models.show', compact('model'));
    }

    public function summarize(Request $request, $key)
    {
        $request->validate([
            'text' => 'required|string'
        ]);

        $result = $this->aiService->summarize($key, $request->text);

        return response()->json([
            'success' => $result['success'],
            'summary' => $result['success'] ? $result['data'] : null,
            'message' => $result['message']
        ]);
    }

}
