<!DOCTYPE html>
<html>
<head>
    <title>AI Models</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
            color: #fff;
        }

        .main-card {
            background: rgba(20, 20, 30, 0.95);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }

        .section-title {
            color: #a78bfa;
            font-weight: 600;
        }

        .model-card {
            background: #1a1a2e;
            border-radius: 15px;
            transition: 0.3s;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .model-card:hover {
            transform: translateY(-6px);
            border: 1px solid #8b5cf6;
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
        }

        .btn-purple {
            background: linear-gradient(45deg, #8b5cf6, #7c3aed);
            border: none;
            border-radius: 30px;
            color: #fff;
            padding: 8px 20px;
        }

        .text-muted-dark {
            color: #aaa !important;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">🧠 AI Models</h1>
        <p class="text-muted-dark">Choose a provider and implementation to summarize your content</p>
    </div>

    <div class="card main-card p-4">

        <!-- Loop Categories -->
        @foreach($categories as $category)

            <h4 class="section-title mt-3 mb-3">
                {{ $category->name }}
            </h4>

            <div class="row">

                @foreach($category->models as $model)
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('models.show', $model->slug) }}" class="text-decoration-none">
                            <div class="card model-card p-4 text-center">

                                <!-- Dynamic Icon -->
                                @if($model->type === 'package')
                                    <i class="bi bi-box-seam text-primary display-6"></i>
                                @elseif($model->type === 'api')
                                    <i class="bi bi-cloud-arrow-up text-success display-6"></i>
                                @elseif($model->type === 'responses')
                                    <i class="bi bi-lightning-charge text-warning display-6"></i>
                                @else
                                    <i class="bi bi-cpu text-info display-6"></i>
                                @endif

                                <h5 class="mt-3 text-white">{{ $model->name }}</h5>
                                <p class="text-muted-dark small">{{ $model->description }}</p>

                                <span class="btn btn-purple mt-2">
                                    Use Model
                                </span>

                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        @endforeach

    </div>

    <!-- Footer -->
    <div class="text-center mt-4 small text-muted-dark">
        Multi-AI Platform (OpenAI, Grok, Gemini...) 🚀
    </div>

</div>

</body>
</html>