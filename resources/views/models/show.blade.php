<!DOCTYPE html>
<html>
<head>
    <title>{{ $model->name }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        textarea {
            background: #1a1a2e !important;
            color: #fff !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
        }

        textarea::placeholder {
            color: #aaa;
        }

        .btn-purple {
            background: linear-gradient(45deg, #8b5cf6, #7c3aed);
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            color: #fff;
        }

        .result-box {
            background: #111827;
            border-radius: 10px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,0.08);
            color: #ddd;
        }

        .text-muted-dark {
            color: #aaa !important;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <div class="col-lg-8 mx-auto">

        <!-- Header -->
        <div class="text-center mb-4">
            <h2 class="fw-bold">🤖 {{ $model->name }}</h2>
            <p class="text-muted-dark">{{ $model->description }}</p>
        </div>

        <!-- Card -->
        <div class="card main-card p-4">

            <h5 class="section-title mb-3">Enter Text to Summarize</h5>

            <textarea id="text" class="form-control mb-3" rows="6" placeholder="Paste your text here..."></textarea>

            <button id="summarizeBtn" class="btn btn-purple w-100">
                ✨ Summarize
            </button>

            <!-- Loader -->
            <div class="text-center mt-3 d-none" id="loader">
                <div class="spinner-border text-light"></div>
            </div>

            <!-- Result -->
            <div class="mt-4">
                <h6 class="section-title">Summary:</h6>
                <div id="result" class="result-box mt-2">
                    Your summary will appear here...
                </div>
            </div>

        </div>

        <!-- Back -->
        <div class="text-center mt-4">
            <a href="{{ route('models.index') }}" class="text-muted-dark">
                ← Back to Models
            </a>
        </div>

    </div>
</div>

<script>
document.getElementById('summarizeBtn').addEventListener('click', function () {

    let text = document.getElementById('text').value;

    if (!text) {
        alert('Please enter text');
        return;
    }

    document.getElementById('loader').classList.remove('d-none');
    document.getElementById('result').innerText = '';

    fetch("{{ route('models.summarize', $model->key) }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ text: text })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('loader').classList.add('d-none');

        if (data.success) {
            document.getElementById('result').innerText = data.summary;
        } else {
            document.getElementById('result').innerText = data.message;
        }
    })
    .catch(() => {
        document.getElementById('loader').classList.add('d-none');
        document.getElementById('result').innerText = 'Something went wrong';
    });
});
</script>

</body>
</html>