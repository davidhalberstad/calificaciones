<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laraveles</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
            <div id="app" class="content">
                <denuncia-component></denuncia-component><!--Añadimos nuestro componente vuejs-->
            </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
