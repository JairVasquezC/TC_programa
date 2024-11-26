<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Inicio de sesión del sistema" />
    <meta name="author" content="SakCode" />
    <title>Sistema de ventas - Login</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #ffffff; /* Fondo claro de la página */
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center; /* Centra el contenedor de login horizontalmente */
            align-items: center; /* Centra el contenedor de login verticalmente */
        }

        /* Contenedor de las dos columnas */
        .login-container {
            display: flex;
            width: 80%;
            height: 80%;

            justify-content: center; /* Centra el contenedor de login horizontalmente */
            align-items: center; /* Centra el contenedor de login verticalmente */

        }

        /* Columna izquierda (Celeste) */
        .login-left {
            background-color: #ffffff; /* Celeste */
            width: 28%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card1 {
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Columna derecha (Formulario de login) */
        .login-right {
            background-color: #ffffff;
            width: 28%;
            display: flex;
            justify-content: center;
            align-items: center;
           
        }

        .login-right .card {
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ffffff;
            text-align: center;
            padding: 38px;
        }

        .card-header img {
            max-height: 80px; /* Ajustamos el tamaño del logo */
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
            background-color:#ffffff;
        }

        .btn-primary {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-primary:hover {
            background-color: #a71d2a;
            border-color: #9f1a24;
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .login-left img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .card-header h3 {
            color: #1c724e;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Columna de la izquierda (Imagen y color celeste) -->
        <div class="login-left">
            <div class="card1">
                <img src="assets/img/login.jpg" alt="Logo" />
            </div>
        </div>

        <!-- Columna de la derecha (Formulario de login) -->
        <div class="login-right">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header">
                    <img src="assets/img/oficial.png" alt="Logo" />
                    <h3 class="font-weight-light my-2 text-dark">Acceder al sistema</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    @foreach ($errors->all() as $item)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$item}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    @endif
                    <form action="/login" method="post">
                        @csrf
                        <div class="form-floating mb-4">
                            <input autofocus autocomplete="off" value="luz@gmail.com" class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                            <label for="inputEmail">Correo electrónico</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input class="form-control" name="password" value="12345678" id="inputPassword" type="password" placeholder="Password" />
                            <label for="inputPassword">Contraseña</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0 text-center">
                            <button class="btn btn-secondary" type="submit" style="background: #E01A1A">Iniciar sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwL
