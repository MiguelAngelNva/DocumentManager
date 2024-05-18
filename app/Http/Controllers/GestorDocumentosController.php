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
        $documentos = Doc_documento::get();
        $proProceso = Pro_proceso::get();
        $tipTipoDoc = Tip_tipo_doc::get();
        return view('gestorDocumentos')->with(compact('documentos', 'proProceso', 'tipTipoDoc'));
    }

    public function registerDocument(){
        $proProceso = Pro_proceso::get();
        $tipTipoDoc = Tip_tipo_doc::get();
        return view('registerDocument')->with(compact('proProceso', 'tipTipoDoc'));
    }

    public function saveDocument(Request $request){

        $validacionDatos = $request->validate([
            'nombreDocumento' => 'required',
            'tipoDoc' => 'required',
            'procesoDocumento' => 'required',
            'contenidoDocumento' => 'required'
        ]);

        if(!$validacionDatos){
            return back()->with('error', 'Datos incompletos');
        }

        $idProceso = $request->procesoDocumento;
        $idTipo = $request->tipoDoc;

        $ultimoArchivo = Doc_documento::where('DOC_ID_TIPO', $idTipo)->where('DOC_ID_PROCESO', $idProceso)->orderBy("DOC_ID", 'desc')->first();
        $getProProceso = Pro_proceso::where('PRO_ID', $idProceso)->first();
        $get_tip_tipo_doc = Tip_tipo_doc::where('TIP_ID', $idTipo)->first();

        $procesoPrefijo = $getProProceso->PRO_PREFIJO;
        $tipoPrefijo = $get_tip_tipo_doc->TIP_PREFIJO;

        if ($ultimoArchivo) {
            $ultimoCodigo = $ultimoArchivo->DOC_CODIGO;
            $ultimoConsecutivo = (int) substr($ultimoCodigo, strrpos($ultimoCodigo, '-') + 1);
            $nuevoConsecutivo = $ultimoConsecutivo + 1;
        } else {
            $nuevoConsecutivo = 1;
        }

        $codigoUnico = "$tipoPrefijo-$procesoPrefijo-$nuevoConsecutivo";
        
        Doc_documento::create([
            "DOC_NOMBRE" => $request->nombreDocumento,
            "DOC_CODIGO" => $codigoUnico,
            "DOC_CONTENIDO" => $request->contenidoDocumento,
            "DOC_ID_TIPO" => $idTipo,
            "DOC_ID_PROCESO" => $idProceso
        ]);

        return back()->with('success', 'Documento registrado exitosamente');

    }

    public function editDocument(Request $request){

        $validacionDatos = $request->validate([
            'nombreDocumento' => 'required',
            'tipoDoc' => 'required',
            'procesoDocumento' => 'required',
            'contenidoDocumento' => 'required'
        ]);

        if(!$validacionDatos){
            return back()->with('error', 'Datos incompletos');
            
        }

        $idDoc = $request->documentId;
        $idProceso = $request->procesoDocumento;
        $idTipo = $request->tipoDoc;

        $ultimoArchivo = Doc_documento::where('DOC_ID_TIPO', $idTipo)->where('DOC_ID_PROCESO', $idProceso)->orderBy("DOC_ID", 'desc')->first();
        $getProceso = Pro_proceso::where('PRO_ID', $idProceso)->first();
        $getTipo = Tip_tipo_doc::where('TIP_ID', $idTipo)->first();

        $procesoPrefijo = $getProceso->PRO_PREFIJO;
        $tipoPrefijo = $getTipo->TIP_PREFIJO;

        if ($ultimoArchivo) {
            $ultimoCodigo = $ultimoArchivo->DOC_CODIGO;
            $ultimoConsecutivo = (int) substr($ultimoCodigo, strrpos($ultimoCodigo, '-') + 1);
            $nuevoConsecutivo = $ultimoConsecutivo + 1;
        } else {
            $nuevoConsecutivo = 1;
        }

        $codigoUnico = "$tipoPrefijo-$procesoPrefijo-$nuevoConsecutivo";

        Doc_documento::where('DOC_ID', $idDoc)->update([
            "DOC_NOMBRE" => $request->nombreDocumento,
            "DOC_CODIGO" => $codigoUnico,
            "DOC_CONTENIDO" => $request->contenidoDocumento,
            "DOC_ID_TIPO" => $idTipo,
            "DOC_ID_PROCESO" => $idProceso
        ]);

        return back()->with('success', 'El documetno ha sido actualizado');

    }

    public function eliminarDocumento(Request $request){
        $idDoc = $request->id;
        $documento = Doc_documento::where('DOC_ID', $idDoc)->first();

        if($documento){
            $documento->delete();

            return back()->with('success', 'el odcumento ha sido elminado correctamente');
        }else{
            return back()->with('error', 'No se ha encontrado el documento');
        }

    }
}
