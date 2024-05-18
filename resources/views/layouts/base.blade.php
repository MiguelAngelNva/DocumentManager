<!doctype html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        @yield('header')

        <style>
            .icono {
                font-size: 2em;
            }
        </style>
    </head>

    <body>
        <header>
            <header class="pc-header">
                <div class="text-end">
                    <div class="dropdown">
                        <i class="bi bi-list icono dropdown-toggle"  type="button" id="dropDownHeader" data-bs-toggle="dropdown" aria-expanded="false"></i>
                        
                        <ul class="dropdown-menu" aria-labelledby="dropDownHeader">
                            <li><a class="dropdown-item" href="{{route('logout')}}">logout</a></li>
                        </ul>
                    </div>
                </div>
            </header>
        </header>
        <main>@yield('content')</main>

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- end Boostrap Icons --}}

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        {{-- end Boostrap libraries --}}

        {{-- sweetAlert libraries--}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- end Sweet alert libraries --}}

        {{-- axios libraries --}}
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        {{-- end Axios libraries --}}

        @yield('scripts')

        @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de autenticación',
                    text: '{{ session('error') }}'
                });
            </script>
        @endif

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Todo ha salido bien!'
                });
            </script>
        @endif
    </body>
</html>
