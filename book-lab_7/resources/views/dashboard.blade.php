<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Reading List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">My Reading List</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white-50">{{ auth()->user()->name }}</span>
            {{-- Logout: POST with CSRF. Change the route name/URL if yours differs. --}}
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Register a book --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-semibold">Register a Book</div>
        <div class="card-body">
            <form method="POST" action="{{ route('books.store') }}" novalidate>
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" id="author" name="author"
                               class="form-control @error('author') is-invalid @enderror"
                               value="{{ old('author') }}">
                        @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="pages" class="form-label">Pages</label>
                        <input type="number" id="pages" name="pages"
                               class="form-control @error('pages') is-invalid @enderror"
                               value="{{ old('pages') }}">
                        @error('pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save Book</button>
            </form>
        </div>
    </div>

    {{-- My Books --}}
    <div class="card shadow-sm mb-5">
        <div class="card-header fw-semibold">My Books</div>
        <div class="card-body p-0">
            @if ($books->isEmpty())
                <p class="text-muted text-center my-4">You have not registered any books yet.</p>
            @else
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:70px">No.</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Pages</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->pages }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
