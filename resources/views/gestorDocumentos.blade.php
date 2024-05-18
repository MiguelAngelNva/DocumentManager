<!doctype html>
<html lang="en">
    <head>
        <title>gestor de Documentos</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <style>
            .icono {
                font-size: 2em;
            }

            .table-height{
                max-height: 400px;
                overflow-y: auto;
            }
        </style>
    </head>

    <body>
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
        <main>
            <div class="container mt-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8 text-start">
                                <h3 class=>Tabla de Documentos</h3>
                            </div>
                            <div class="col-4 text-end">
                                <input class="form-control" type="text" placeholder="Buscar">
                                <a class="btn btn-primary mt-1" type="button" href="{{route('registerDocument')}}">
                                    <span>Subir Documento <i class="bi bi-plus-circle"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-height">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Proceso</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentos as $documento)
                                <tr>
                                    <th scope="row">{{$documento->DOC_ID}}</th>
                                    <td>{{$documento->DOC_NOMBRE}}</td>
                                    <td>{{$documento->DOC_CODIGO}}</td>
                                    <td>{{$documento->tipo->TIP_NOMBRE}}</td>
                                    <td>{{$documento->proceso->PRO_NOMBRE}}</td>
                                    <td>
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item">
                                                <a href="" onclick="cargarContenidoDocumentos({{$documento->DOC_ID}})" title="View Doc." data-bs-toggle="modal" data-bs-target="#viewDocument">
                                                    <i class="bi bi-file-text"></i>
                                                </a>
                                            </li>

                                            <li class="list-inline-item">
                                                <a href="" title="Edit Doc." data-bs-toggle="modal" data-bs-target="#editDocument">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </li>


                                            <li class="list-inline-item">
                                                <a href="" title="Delete Doc.">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>


                <div class="modal fade" id="viewDocument" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tituloDocumento">Document</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span id="cargarContenidoDocumentos"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editDocument" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </main>

        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        <script>

            function cargandoContenido(){
                    $("#tituloDocumento").html('<i class="bi bi-arrow-clockwise"></i>');
                    $("#cargarContenidoDocumentos").html('<i class="bi bi-arrow-clockwise"></i>');
            }

            function cargarContenidoDocumentos(DOC_ID){
                cargandoContenido();

                axios.post('{{route("cargarContenidoDocumentos")}}',{
                    headers : {
                        "X-CSRF-TOKEN" : "{{csrf_token()}}"
                    },
                    DOC_ID
                }).then(res=>{
                    let data = res.data.documento;
                    console.log(data);

                    $("#tituloDocumento").html(data.DOC_NOMBRE);
                    $("#cargarContenidoDocumentos").html(data.DOC_CONTENIDO);

                }).catch(e=>{
                    Swal.fire('','Ha ocurrido un error intentalo mas tarde','error');
                });
            }
        </script>
        
    </body>
</html>

