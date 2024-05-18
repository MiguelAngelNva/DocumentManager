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

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
  
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

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
                max-height: 580px;
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
                                <a class="btn btn-primary mt-1" type="button" href="{{route('registerDocument')}}">
                                    <span>Subir Documento <i class="bi bi-plus-circle"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-height">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Proceso</th>
                                    <th scope="col">Actions</th>
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
                                                <a href="#" onclick="cargarContenidoDocumentos({{$documento->DOC_ID}})" title="View Doc." data-bs-toggle="modal" data-bs-target="#viewDocument">
                                                    <i class="bi bi-file-text"></i>
                                                </a>
                                            </li>

                                            <li class="list-inline-item">
                                                <a href="#" onclick="cargarContenidoDocumentos({{$documento->DOC_ID}})" title="Edit Doc." data-bs-toggle="modal" data-bs-target="#editDocument">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </li>


                                            <li class="list-inline-item">
                                                <a href="#" onclick="eliminarDocumento('{{route('eliminarDocumento', $id = $documento->DOC_ID)}}')" title="Delete Doc.">
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
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Documento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="{{route('editDocument')}}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <input type="hidden" name="documentId" id="documentId">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nombre del documento:</label>
                                                <input id="nombreDocumento" name="nombreDocumento" type="text" class="form-control" placeholder="Nombre del documento" required>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <div class="form-group">
                                                <label class="form-label">Tipo del documento:</label>
                                                <select class="form-select" name="tipoDocumento" id="tipoDocumento" required>
                                                    <option disabled selected>Seleccione un Tipo de documento</option>
                                                    @foreach($tipTipoDoc as $tipo)
                                                    <option value="{{$tipo->TIP_ID}}">{{$tipo->TIP_NOMBRE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6 mt-2">
                                            <div class="form-group">
                                                <label class="form-label">Proceso del documento:</label>
                                                <select class="form-select" name="procesoDocumento" id="procesoDocumento" required>
                                                    <option disabled selected>Seleccione un Proceso de documento</option>
                                                    @foreach($proProceso as $proceso)
                                                    <option value="{{$proceso->PRO_ID}}">{{$proceso->PRO_NOMBRE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="" class="form-label"></label>
                                                <textarea class="form-control" name="contenidoDocumento" id="contenidoDocumento" rows="3" placeholder="Escriba el contenido del documento" required></textarea>
                                            </div>
                                            
                                        </div>
                                    </div>

                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                               
                        </div>
                    </div>
                </div>

            </div>

        </main>

        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

        <script>$(document).ready( function () {
            $('#myTable').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        } );</script>

        <script>

            function cargandoContenido(){
                // Limpieza de datos en view Document 
                $("#tituloDocumento").html('<i class="bi bi-arrow-clockwise"></i>');
                $("#cargarContenidoDocumentos").html('<i class="bi bi-arrow-clockwise"></i>');

                // limpeza de datos en Edit Document
                $("#nombreDocumento").val("");
                $("#tipoDocumento").val("");
                $("#procesoDocumento").val("");
                $("#contenidoDocumento").val("");
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

                    //Cargar datos en view Document 
                    $("#tituloDocumento").html(data.DOC_NOMBRE);
                    $("#cargarContenidoDocumentos").html(data.DOC_CONTENIDO);

                    // Cargar datos en Edit Document
                    $("#nombreDocumento").val(data.DOC_NOMBRE);
                    $("#tipoDocumento").val(data.DOC_ID_TIPO);
                    $("#procesoDocumento").val(data.DOC_ID_PROCESO);
                    $("#contenidoDocumento").val(data.DOC_CONTENIDO);
                    $("#documentId").val(data.DOC_ID);

                }).catch(e=>{
                    Swal.fire('','Ha ocurrido un error intentalo mas tarde','error');
                });
            }

            function eliminarDocumento(route){
                Swal.fire({
                    title: "Estas seguro?",
                    text: "Una vez eliminado no se podrá recuperar",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar"
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location = route;
                    }
                })
            }
        </script>
        
    </body>
</html>

