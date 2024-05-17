<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'doc_documento';

    protected $primaryKey = 'doc_id';

    protected $fillable = [
        'doc_nombre',
        'doc_codigo',
        'doc_contenido',
        'doc_id_tipo',      //foranea de tabla tip_tipo_doc
        'doc_id_proceso',   //foranea de tabla pro_proceso
    ];

    // relaciones de documento hacia tipo y proceso
    public function documentType(){
        $this->belongsTo(DocumentType::class,  'doc_id_tipo', 'tip_id');
    }

    public function documentProcess(){
        $this->belongsTo(DocumentProcess::class,  'doc_id_proceso', 'pro_id');
    }
}
