<!DOCTYPE html>
<html data-bs-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" charset="utf-8"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons 1.11.1 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet" />

    <!-- Bootstrap 5.3.2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" />

    @yield('Head_JS')

    @yield('Head_CSS')

    <style>
        #Loader {
            background-color: rgba(125, 125, 125, 0.5);
            position: fixed;
            z-index: 9999;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

{{-- <body class="container-fluid d-flex py-4 w-100 justify-content-center align-items-center"> --}}

<div class="container-fluid" id="Loader">
    <div class="center-content">
        <img src="{{ asset('Loading.gif') }}" />
    </div>
</div>

<body class="container-fluid w-100 h-100 p-0 m-0">
    @yield('content')

    @yield('Modal')

    <!-- Bootstrap JS 5.3.2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- JQuery JS 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Auto Height Textarea JS -->
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('#Loader').style.display = 'none';
            }, 1000);
        });

        $(document).ready(function() {
            $('textarea').on('input', function() {
                this.style.height = 'auto';
                this.style.height = ((this.scrollHeight) + 5) + 'px';
            }).each(function() {
                $(this).trigger('input');
            });
        });

        function AutoHeightTextArea() {
            $('textarea').on('input', function() {
                this.style.height = 'auto';
                this.style.height = ((this.scrollHeight) + 5) + 'px';
            }).each(function() {
                $(this).trigger('input');
            });
        }
    </script>

    @yield('Body_JS')
</body>

</html>
