<!doctype html>
<html lang="en">
    <head>
        <title>prueba Tecnica Innclod</title>
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
    </head>

    <body>
        <main> 
            <div class="container">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">

                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="card mt-5">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h3>Login</h3>
                                    </div>

                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" placeholder="Correo electronico">
                                    </div>

                                    <div class="form-group mt-1">
                                        <input name="password" type="password" class="form-control" placeholder="Contraseña">
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">Entrar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-3"></div>
                </div>
            </div> 
        </main>

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
        <!-- Bootstrap JavaScript Libraries end -->
    </body>
</html>
