<?php

namespace App\Services;

use App\Models\Document\Document;
use App\Models\Document\DocumentProcess;
use App\Models\Document\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentService implements DocumentServiceInterface
{
    public function getTypes(){
        return DocumentType::all();
    }

    public function getProcesses(){
        return DocumentProcess::all();
    }

    public function getDocuments(){
        return Document::with(['documentType', 'documentProcess'])->get();
    }

    public function getDocumentById($id){
        return Document::with(['documentType', 'documentProcess'])->find($id);
    }

    public function storeDocument(Request $request){
        $data = $request->all();

        if ($request->hasFile('doc_contenido')) {
            $path = $request->file('doc_contenido')->store('documents', 'public');
            $data['doc_contenido'] = $path;
        }

        $document = new Document();
        $document->fill($data);
        $document->save();

        return $document;
    }

    public function updateDocument($id, Request $request){
        $data = $request->all();

        $document = Document::findOrFail($id);

        if ($request->hasFile('doc_contenido')) {
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            $path = $request->file('doc_contenido')->store('documents', 'public');
            $data['doc_contenido'] = $path;
        }

        $document->fill($data);
        $document->save();

        return $document;
    }

    public function deleteDocument($id){
        $document = Document::findOrFail($id);
        $document->delete();
    }
}

