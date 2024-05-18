<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// models
use App\Models\Pro_proceso;
use App\Models\Tip_tipo_doc;
use App\Models\Doc_documento;


class GestorDocumentosController extends Controller
{
    public function gestorDocumentos(){
        // Obtencion de contenidos de la base de datos para mandarla al front junto a la vista
        $documentos = Doc_documento::get();
        $proProceso = Pro_proceso::get();
        $tipTipoDoc = Tip_tipo_doc::get();
        return view('gestorDocumentos')->with(compact('documentos', 'proProceso', 'tipTipoDoc'));
    }

    public function registerDocument(){
        // Obtencion de contenidos de la base de datos para mandarla al front junto a la vista
        $proProceso = Pro_proceso::get();
        $tipTipoDoc = Tip_tipo_doc::get();
        return view('registerDocument')->with(compact('proProceso', 'tipTipoDoc'));
    }

    public function saveDocument(Request $request){

        // Validacion de datos llegados del formulario
        $validacionDatos = $request->validate([
            'nombreDocumento' => 'required',
            'tipoDoc' => 'required',
            'procesoDocumento' => 'required',
            'contenidoDocumento' => 'required'
        ]);

        if(!$validacionDatos){
            return back()->with('error', 'Datos incompletos');
        }

        // obtencion de los Id
        $idProceso = $request->procesoDocumento;
        $idTipo = $request->tipoDoc;

        // Logica SQL para obtener el ultimo archivo en donde coincida con el Tipo y proceso llegados del formulario
        $ultimoArchivo = Doc_documento::where('DOC_ID_TIPO', $idTipo)->where('DOC_ID_PROCESO', $idProceso)->orderBy("DOC_ID", 'desc')->first();
        
        // Logica SQL para obtener los datos de las tablas Pro_proceso y Tip_tipo_doc que coincidan con los id llegados del formulario
        $getProProceso = Pro_proceso::where('PRO_ID', $idProceso)->first();
        $getTipTipo = Tip_tipo_doc::where('TIP_ID', $idTipo)->first();

        // Logica para Obtener los prefijos dependiendo de los resultados llegados del formulario
        $procesoPrefijo = $getProProceso->PRO_PREFIJO;
        $tipoPrefijo = $getTipTipo->TIP_PREFIJO;

        // Logica para obtener el nuevo número que llevará el codigo Unico
        if ($ultimoArchivo) {
            $ultimoCodigo = $ultimoArchivo->DOC_CODIGO;
            $ultimoConsecutivo = (int) substr($ultimoCodigo, strrpos($ultimoCodigo, '-') + 1);
            $nuevoConsecutivo = $ultimoConsecutivo + 1;
        } else {
            $nuevoConsecutivo = 1;
        }

        // Estructura del codigo único
        $codigoUnico = "$tipoPrefijo-$procesoPrefijo-$nuevoConsecutivo";
        
        // Creacion del nuevo documento
        Doc_documento::create([
            "DOC_NOMBRE" => $request->nombreDocumento,
            "DOC_CODIGO" => $codigoUnico,
            "DOC_CONTENIDO" => $request->contenidoDocumento,
            "DOC_ID_TIPO" => $idTipo,
            "DOC_ID_PROCESO" => $idProceso
        ]);

        return redirect()->route('gestorDocumentos')->with('success', 'Documento registrado exitosamente');

    }

    public function editDocument(Request $request){

        // Validacion de datos llegados del formulario
        $validacionDatos = $request->validate([
            'nombreDocumento' => 'required',
            'tipoDocumento' => 'required',
            'procesoDocumento' => 'required',
            'contenidoDocumento' => 'required'
        ]);

        if(!$validacionDatos){
            return back()->with('error', 'Datos incompletos');
            
        }

        // obtencion de los Id 
        $idDoc = $request->documentId;
        $idTipo = $request->tipoDocumento;
        $idProceso = $request->procesoDocumento;
        
        // obtencion del documento que se está editando
        $documentoActual = Doc_documento::where('DOC_ID', $idDoc)->first();

        // Logica para verificar si el Tipo o Proceso han cambiado para el Codigo Unico
        if($documentoActual->DOC_ID_TIPO !== $idTipo || $documentoActual->DOC_ID_PROCESO !== $idProceso){
            // Logica SQL para obtener el ultimo archivo en donde coincida con el Tipo y proceso llegados del formulario
            $ultimoArchivo = Doc_documento::where('DOC_ID_TIPO', $idTipo)->where('DOC_ID_PROCESO', $idProceso)->orderBy("DOC_ID", 'desc')->first();
            
            // Logica SQL para obtener los datos de las tablas Pro_proceso y Tip_tipo_doc que coincidan con los id llegados del formulario
            $getProProceso = Pro_proceso::where('PRO_ID', $idProceso)->first();
            $getTipTipo = Tip_tipo_doc::where('TIP_ID', $idTipo)->first();

            // Logica para Obtener los prefijos dependiendo de los resultados llegados del formulario
            $procesoPrefijo = $getProProceso->PRO_PREFIJO;
            $tipoPrefijo = $getTipTipo->TIP_PREFIJO;

            // Logica para obtener el nuevo número que llevará el codigo Unico
            if ($ultimoArchivo) {
                $ultimoCodigo = $ultimoArchivo->DOC_CODIGO;
                $ultimoConsecutivo = (int) substr($ultimoCodigo, strrpos($ultimoCodigo, '-') + 1);
                $nuevoConsecutivo = $ultimoConsecutivo + 1;
            } else {
                $nuevoConsecutivo = 1;
            }

            // Estructura del codigo único
            $codigoUnico = "$tipoPrefijo-$procesoPrefijo-$nuevoConsecutivo";
        }else{
            // Si el Tipo o proceso no han cambiado, se dejará el mismo DOC_CODIGO que ya tenía el documento
            $codigoUnico = $documentoActual->DOC_CODIGO;
        }

        // Actualizado del documento actual 
        $documentoActual->update([
            "DOC_NOMBRE" => $request->nombreDocumento,
            "DOC_CODIGO" => $codigoUnico,
            "DOC_CONTENIDO" => $request->contenidoDocumento,
            "DOC_ID_TIPO" => $idTipo,
            "DOC_ID_PROCESO" => $idProceso
        ]);


        return back()->with('success', 'el documento ha sido actualizado');
    }

    public function eliminarDocumento(Request $request){

        // Obtencion de los Id para buscar el  documento
        $idDoc = $request->id;
        $documento = Doc_documento::where('DOC_ID', $idDoc)->first();

        // Logica de eliminacion de documentos
        if($documento){
            $documento->delete();
            return back()->with('success', 'el odcumento ha sido elminado correctamente');
        }else{
            return back()->with('error', 'No se ha encontrado el documento');
        }

    }
}
