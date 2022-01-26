<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="bg-dark">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 mx-auto text-center p-5 m-5">
                    <h1 class="text-white ">Bem-vindo ao Husky Test</h1>
                    
                    <div class="row mt-4">
                        <div class="col-6">
                            <a href="{{ route('login') }}" class="btn btn-primary col-8 btn-lg">Login</a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('register') }}" class="btn btn-secondary col-8 btn-lg">Registrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
