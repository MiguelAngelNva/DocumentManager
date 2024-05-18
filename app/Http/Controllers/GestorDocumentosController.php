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
        $pro_proceso = Pro_proceso::get();
        $tip_tipo_doc = Tip_tipo_doc::get();
        return view('gestorDocumentos')->with(compact('documentos', 'pro_proceso', 'tip_tipo_doc'));
    }

    public function registerDocument(){
        $pro_proceso = Pro_proceso::get();
        $tip_tipo_doc = Tip_tipo_doc::get();
        return view('registerDocument')->with(compact('pro_proceso', 'tip_tipo_doc'));
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
        $get_pro_proceso = Pro_proceso::where('PRO_ID', $idProceso)->first();
        $get_tip_tipo_doc = Tip_tipo_doc::where('TIP_ID', $idTipo)->first();

        $pro_prefijo = $get_pro_proceso->PRO_PREFIJO;
        $tipo_prefijo = $get_tip_tipo_doc->TIP_PREFIJO;

        if ($ultimoArchivo) {
            $ultimoCodigo = $ultimoArchivo->DOC_CODIGO;
            $ultimoConsecutivo = (int) substr($ultimoCodigo, strrpos($ultimoCodigo, '-') + 1);
            $nuevoConsecutivo = $ultimoConsecutivo + 1;
        } else {
            $nuevoConsecutivo = 1;
        }

        $codigo = "$tipo_prefijo-$pro_prefijo-$nuevoConsecutivo";
        
        Doc_documento::create([
            "DOC_NOMBRE" => $request->nombreDocumento,
            "DOC_CODIGO" => $codigo,
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
        $get_pro_proceso = Pro_proceso::where('PRO_ID', $idProceso)->first();
        $get_tip_tipo_doc = Tip_tipo_doc::where('TIP_ID', $idTipo)->first();

        $pro_prefijo = $get_pro_proceso->PRO_PREFIJO;
        $tipo_prefijo = $get_tip_tipo_doc->TIP_PREFIJO;

        if ($ultimoArchivo) {
            $ultimoCodigo = $ultimoArchivo->DOC_CODIGO;
            $ultimoConsecutivo = (int) substr($ultimoCodigo, strrpos($ultimoCodigo, '-') + 1);
            $nuevoConsecutivo = $ultimoConsecutivo + 1;
        } else {
            $nuevoConsecutivo = 1;
        }

        $codigo = "$tipo_prefijo-$pro_prefijo-$nuevoConsecutivo";

        Doc_documento::where('DOC_ID', $idDoc)->update([
            "DOC_NOMBRE" => $request->nombreDocumento,
            "DOC_CODIGO" => $codigo,
            "DOC_CONTENIDO" => $request->contenidoDocumento,
            "DOC_ID_TIPO" => $idTipo,
            "DOC_ID_PROCESO" => $idProceso
        ]);

        return back()->with('success', 'El documetno ha sido actualizado');

    }
}
