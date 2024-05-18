@extends('layouts.base')
@section('title', 'Registro Documento')

@section('content')
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
                                        @foreach($tipTipoDoc as $tipo)
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
                                        @foreach($proProceso as $proceso)
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
@endsection


