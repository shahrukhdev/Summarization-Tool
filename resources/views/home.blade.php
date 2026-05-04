<!DOCTYPE html>
<html>
<head>
    <title>AI Summarization Tool</title>

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

        h1, h2, h3, h4, h5 {
            color: #ffffff;
        }

        .main-card {
            background: rgba(20, 20, 30, 0.95);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            transition: 0.3s;
        }

        .section-title {
            color: #a78bfa;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .feature-item {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            color: #ddd;
            transition: 0.3s;
        }

        .feature-item:hover {
            background: rgba(139, 92, 246, 0.15);
            transform: scale(1.02);
        }

        .btn-purple {
            background: linear-gradient(45deg, #8b5cf6, #7c3aed);
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            color: #fff;
        }

        .btn-purple:hover {
            opacity: 0.9;
        }

        .text-muted-dark {
            color: #aaa !important;
        }
    </style>
</head>

<body>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="col-lg-8">

        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5">🤖 AI Summarization Tool</h1>
            <p class="text-muted-dark">Turn long content into short, powerful summaries instantly. Supports multiple AI providers like OpenAI, Grok, Gemini, and more.</p>
        </div>

        <!-- Main Card -->
        <div class="card main-card shadow-lg p-4">

            <!-- FEATURES -->
            <h4 class="section-title mb-3">✨ What can this tool do?</h4>

            <div class="list-group mb-4">
                <div class="list-group-item feature-item">
                    <i class="bi bi-file-text text-info me-2"></i>
                    Convert long articles into concise summaries
                </div>
                <div class="list-group-item feature-item">
                    <i class="bi bi-lightbulb text-warning me-2"></i>
                    Extract key insights in seconds
                </div>
            </div>

            <!-- SEE ALL MODELS -->
            <div class="text-center mt-4">
                <a href="{{ route('models.index') }}" class="btn btn-purple btn-lg">See All Models</a>
            </div>

        </div>

        <!-- Footer -->
        <div class="text-center mt-4 small text-muted-dark">
            Built with Laravel + AI Integration 🚀
        </div>

    </div>
</div>

</body>
</html>