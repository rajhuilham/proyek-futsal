<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Login - Harfelly Hall</title>
    <style>
        body, html { height: 100%; }
        body { background-color: #f8f9fa; }
    </style>
</head>
<body>

    @if (session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Sukses</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-center h-100">
        <div class="card shadow" style="width: 25rem;">
            <div class="card-header bg-white py-3 border-0">
                <div class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dribbble" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M1.542 4.243a6.5 6.5 0 0 1 10.21 6.223L6.463 4.025a6.5 6.5 0 0 1 -4.921.218m1.215 7.525a6.5 6.5 0 0 1-4.243-5.334L11.975 8.54a6.5 6.5 0 0 1-9.218 3.228"/>
                    </svg>
                    <span class="fs-5 fw-semibold">Harfelly Hall</span>
                </div>
            </div>

            <div class="card-body pt-0 p-4">
                <h5 class="card-title text-center mb-4 fs-3">Login</h5>
                
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="/register">Belum punya akun? Sign-up</a>
                        <button name="submit" type="submit" class="btn btn-dark px-4">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    @if (session('success'))
        <script>
            const toastLiveExample = document.getElementById('liveToast');
            const toast = new bootstrap.Toast(toastLiveExample);
            toast.show();
        </script>
    @endif

</body>
</html>