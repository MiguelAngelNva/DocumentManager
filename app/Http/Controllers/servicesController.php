<?php

namespace App\Http\Controllers;

use App\Models\Doc_documento;
use Illuminate\Http\Request;

class servicesController extends Controller
{
    public function cargarContenidoDocumentos(Request $request)
    {
        // Obtencion de los Id para buscar el documento
        $docId = $request->DOC_ID;
        $documento = Doc_documento::where('DOC_ID', $docId)->first();
        
        // Logica de envio de documento para cargarlo de forma asincrónica
        if($documento){
            return response()->json(["result" => true, "msg" => "El documento ha sido encontrado", "documento" => $documento]);
        }else{
            return response()->json(["result" => false, "msg" => "No se ha encontrado ningun documento"]);
        } 
        
    }
}
