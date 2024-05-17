<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentProcess extends Model
{
    use HasFactory;

    protected $table = 'pro_proceso';

    protected $primaryKey = 'pro_id';

    protected $fillable = [
        'pro_prefijo',
        'pro_nombre'
    ];

    // relaciones de proceso hacia documentos
    public function documents(){
        $this->hasMany(Document::class, 'doc_id_proceso', 'pro_id');
    }
}
