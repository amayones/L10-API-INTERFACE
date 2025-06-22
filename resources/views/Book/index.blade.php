<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-light">
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if ($errors->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action='' method='post'>
                @if (Route::current()->uri == 'book/{id}')
                    @method('put')
                @endif
                @csrf
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Book Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='title' id="title"
                            value="{{ isset($data['title']) ? $data['title'] : old('title') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='author' id="author"
                            value="{{ isset($data['author']) ? $data['author'] : old('author') }}">
                    </div>
                </div>
                <div class="mb-3
                            row">
                    <label for="tanggal_publikasi" class="col-sm-2 col-form-label">Published Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control w-50" name='published_date' id="published_date"
                            value="{{ isset($data['published_date']) ? $data['published_date'] : old('published_date') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary" name="submit">SAVE</button>
                        <a href="{{ url('book') }}" class="btn btn-sm btn-secondary ms-2">CANCEL</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->
        @if (Route::current()->uri == 'book')
            <!-- START DATA -->
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-4">Title</th>
                            <th class="col-md-3">Author</th>
                            <th class="col-md-2">Published Date</th>
                            <th class="col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['author'] }}</td>
                                <td>{{ date('d/m/Y', strtotime($item['published_date'])) }}</td>
                                <td>
                                    <a href="{{ url('book/' . $item['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ url('book/' . $item['id']) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this book?')"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button typr="submit" class="btn btn-danger btn-sm">Del</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- AKHIR DATA -->
        @endif
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

</body>

</html>
