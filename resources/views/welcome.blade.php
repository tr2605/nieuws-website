<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>News Homepage</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Custom Styles */
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .jumbotron {
                background-color: #ffffff;
                border-radius: 15px;
                padding: 40px;
            }

            .article-title {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }

            .article-description {
                font-size: 1.1rem;
                margin-bottom: 20px;
            }

            .article-link {
                font-size: 1rem;
                margin-top: 10px;
            }
        </style>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Nova Nieuws</span>
                @if (Route::has('login'))
                <div class="justify-content-end">
                    <!-- Add Login/Register links here if needed -->
                </div>
                @endif
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container mt-5">
            <div class="jumbotron">
                <h1 class="display-4">Welkom bij de Nova nieuws website</h1>
                <p class="lead">Blijf up-to-date met het laatste nieuws.</p>
                @foreach ($articles as $article)
                <!-- Article Section -->
                <div class="article">
                    <h1 class="article-title">{{ $article->title }}</h1>
                    <p class="article-description">{{ $article->description }}</p>
                    <a class="btn btn-primary article-link" href="{{ route('article.show', $article->id) }}" role="button">Lees meer</a>
                </div>
                <!-- End of Article Section -->
                @endforeach
                <a class="btn btn-primary btn-lg" href="{{ route('dashboard') }}" role="button">bekijk artikelen</a>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
</x-app-layout>
