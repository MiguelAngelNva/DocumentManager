<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip_tipo_doc extends Model
{
    use HasFactory;

    protected $table = "tip_tipo_doc";

    protected $primaryKey = "TIP_ID";

    protected $fillable = [
        "TIP_NOMBRE",
        "TIP_PREFIJO"
    ];
}
