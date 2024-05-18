<!doctype html>
<html lang="en">
    <head>
        <title>Registro Documento</title>
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
                <div class="col-2"></div>
                    <div class="col-8">
                        <form action="saveDocument" method="post">
                            @csrf
                            <div class="card mt-5">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <div class="text-center">
                                                <h3>Registro documento</h3>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nombre del documento:</label>
                                                <input name="nombreDocumento" type="text" class="form-control" placeholder="Nombre del documento" required>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <div class="form-group">
                                                <label class="form-label">Tipo del documento:</label>
                                                <select class="form-select" name="tipoDoc" id="" required>
                                                    <option disabled selected>Seleccione un Tipo de documento</option>
                                                    @foreach($tip_tipo_doc as $tipo)
                                                    <option value="{{$tipo->TIP_ID}}">{{$tipo->TIP_NOMBRE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6 mt-2">
                                            <div class="form-group">
                                                <label class="form-label">Proceso del documento:</label>
                                                <select class="form-select" name="procesoDocumento" id="" required>
                                                    <option disabled selected>Seleccione un Proceso de documento</option>
                                                    @foreach($pro_proceso as $proceso)
                                                    <option value="{{$proceso->PRO_ID}}">{{$proceso->PRO_NOMBRE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="" class="form-label"></label>
                                                <textarea class="form-control" name="contenidoDocumento" id="" rows="3" placeholder="Escriba el contenido del documento" required></textarea>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <a class="btn btn-danger" href="{{route('gestorDocumentos')}}">Volver</a>
                                    <button class="btn btn-primary" type="submit">Registrar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-2"></div>

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
    </body>
</html>

