<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('{{ asset('img/fondo.jpg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4 p-5 shadow-sm border rounded-5 bg-white" style="border-radius: 2%">
            <h2 class="text-center mb-4 text-primary">Login Form</h2>
            <form action="{{ route('session.login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control border border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control border border-primary" id="exampleInputPassword1"
                        name="password">
                </div>
                <p class="small"><a class="text-primary" href="{{ route('formRecuperarPass') }}">Has olvidado tu
                        contraseña?</a></p>
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
            <div class="mt-3">
                {{-- <p class="mb-0  text-center">Don't have an account? <a href="signup.html"
                        class="text-primary fw-bold">Sign
                        Up</a></p> --}}
                <p class="mb-0  text-center">Registrar incidencia como cliente? <a
                        href="{{ route('formTareaParaClientes') }}" class="text-primary fw-bold">Pincha aqui</a></p>
            </div>
        </div>
    </div>
</body>

</html>
