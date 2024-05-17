<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $table = 'tip_tipo_doc';

    protected $primaryKey = 'tip_id';

    protected $fillable = [
        'tip_nombre',
        'tip_prefijo'
    ];

    // relaciones de tipo hacia documentos
    public function documents(){
        $this->hasMany(Document::class, 'doc_id_tipo', 'tip_id');
    }
}
