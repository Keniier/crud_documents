<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doc_documento', function (Blueprint $table) {
            $table->id('doc_id');
            $table->string('doc_nombre', 50);
            $table->string('doc_codigo');
            $table->text('doc_contenido');
            $table->unsignedBigInteger('doc_id_tipo');
            $table->unsignedBigInteger('doc_id_proceso');
            $table->foreign('doc_id_tipo')->references('tip_id')->on('tip_tipo_doc')->onDelete('cascade');
            $table->foreign('doc_id_proceso')->references('pro_id')->on('pro_proceso')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_documento');
    }
};
