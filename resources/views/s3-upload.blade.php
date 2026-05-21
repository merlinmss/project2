<!DOCTYPE html>
<html>
<head>
    <title>Laravel S3 Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Upload File to Amazon S3</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}<br>
            <a href="{{ session('url') }}" target="_blank">View File</a>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('s3.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Upload to S3</button>
    </form>
</div>
</body>
</html>
