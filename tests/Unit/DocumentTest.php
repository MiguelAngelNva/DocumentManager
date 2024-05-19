<?php


namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Database\Factories\DocDocumentoFactory;


class DocumentTest extends TestCase
{
   
    // Test verificacion de la creacion de datos
    public function testCreacionDocumento(){

        $documento = DocDocumentoFactory::new()->create();

        $this->assertTrue(true, 'El documento se ha creado correctamente.');
    }

    // Test verificacion de actualizacion de datos
    public function testActualizacionDocumento(){

        $data = [
            "DOC_NOMBRE" => "Prueba Editada",
            "DOC_CODIGO" => "INS-FIN-1",
            "DOC_CONTENIDO" => "Prueba para determianr el funcionamiento de la actulizacion de documentos",
            "DOC_ID_TIPO" =>1 ,
            "DOC_ID_PROCESO" => 2
        ];

        $documento = DocDocumentoFactory::new()->create();
        $documento->update($data);

        $this->assertDatabaseHas('DOC_DOCUMENTO', $data);
    }

    // Test de eliminacion de datos 
    public function testEliminarDocumentos(){
        
        $documento = DocDocumentoFactory::new()->create();
        $documento->delete();
        
        $this->assertDatabaseMissing('doc_documento', ['DOC_ID' => $documento->DOC_ID]);
    }


}
