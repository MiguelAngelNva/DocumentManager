<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//clases para relaciones
use App\Models\Tip_tipo_doc;
use App\Models\Pro_proceso;

class Doc_documento extends Model
{
    use HasFactory;

    protected $table = "doc_documento";

    protected $primaryKey = "DOC_ID";

    protected $fillable = [
        "DOC_NOMBRE",
        "DOC_CODIGO",
        "DOC_CONTENIDO",
        "DOC_ID_TIPO",
        "DOC_ID_PROCESO"
    ];

    public function tipo(){
        return $this->hasOne(Tip_tipo_doc::class, 'TIP_ID', 'DOC_ID_TIPO');
    }

    public function proceso(){
        return $this->hasOne(Pro_proceso::class, 'PRO_ID', 'DOC_ID_PROCESO');
    }
}
