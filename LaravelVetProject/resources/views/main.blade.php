<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        {{ $title ?? "Vet clinic"}}
    </title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Vet clinic</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @yield("menu")
            </div>
        </div>
    </div>
    <hr>
    @yield("content") 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    @yield("scripts")
</body>

</html>