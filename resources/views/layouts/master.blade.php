
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gesion Location</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles
    </head>
    <style></style>
    <body class="hold-transition sidebar-max" style="">
        <div class="wrapper">
           <x-forms.menu />
           <x-forms.dashboard />
           <div class="content-wrapper">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-forms.aside />
            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div>

                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>


        @livewireScripts

    </body>
</html>
