<!DOCTYPE html>
<html>
<head>
    <title>API Summary</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
            color: #fff;
        }

        .main-card {
            background: rgba(20, 20, 30, 0.95);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }

        .form-control {
            background: #1a1a2e;
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
        }

        .form-control:focus {
            background: #1a1a2e;
            color: #fff;
            border-color: #22c55e;
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.5);
        }

        .btn-green {
            background: linear-gradient(45deg, #22c55e, #16a34a);
            border: none;
            border-radius: 30px;
            padding: 10px 30px;
            color: #fff;
        }

        .btn-green:hover {
            opacity: 0.9;
        }

        .result-box {
            background: #1a1a2e;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 15px;
            color: #ddd;
            min-height: 100px;
        }

        .section-title {
            color: #86efac;
            font-weight: 600;
        }

        .loader-box {
            text-align: center;
            color: #86efac;
        }

        .subtitle {
            color: #aaa;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="col-lg-8">

        <div class="main-card shadow-lg">

            <h2 class="mb-2 text-center">🌐 Summarization (Direct API)</h2>
            <p class="text-center subtitle mb-4">Manual integration using OpenAI API</p>

            <!-- Input -->
            <label class="section-title mb-2">Enter Your Text</label>
            <textarea id="text" class="form-control mb-3" rows="6" placeholder="Paste your content here..."></textarea>

            <!-- Button -->
            <div class="text-center">
                <button id="summarizeBtn" class="btn btn-green">
                    ⚡ Generate Summary
                </button>
            </div>

            <!-- Loader -->
            <div class="mt-4 d-none loader-box" id="loader">
                <div class="spinner-border text-light"></div>
                <p class="mt-2">Processing your request...</p>
            </div>

            <!-- Result -->
            <div class="mt-4">
                <h5 class="section-title">📄 Summary</h5>
                <div id="result" class="result-box mt-2"></div>
            </div>

        </div>

    </div>
</div>

<script>
document.getElementById('summarizeBtn').addEventListener('click', function () {

    let text = document.getElementById('text').value;

    if (!text.trim()) {
        alert("Please enter some text first.");
        return;
    }

    document.getElementById('loader').classList.remove('d-none');
    document.getElementById('result').innerText = "";

    fetch("{{ route('summary.api') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').content
        },
        body: JSON.stringify({ text: text })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('loader').classList.add('d-none');
        document.getElementById('result').innerText = data.summary;
    })
    .catch(() => {
        document.getElementById('loader').classList.add('d-none');
        document.getElementById('result').innerText = "⚠️ API error. Please try again.";
    });
});
</script>

</body>
</html>