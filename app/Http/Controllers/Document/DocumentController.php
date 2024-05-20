<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Services\DocumentServiceInterface;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $documentService;

    public function __construct(DocumentServiceInterface $service){
        $this->documentService = $service;
    }
    
    // Retornar la lista de Documents
    public function getDocuments()
    {
        $documents = $this->documentService->getDocuments();
        return response()->json(['status' => true, 'documents' => $documents]);
    }

    public function getDocumentById($id)
    {
        $document = $this->documentService->getDocumentById($id);
        return response()->json(['status' => true, 'document' => $document]);
    }

    // Retornar la lista de tipos
    public function getTypes()
    {
        $types = $this->documentService->getTypes();
        return response()->json(['status' => true, 'types' => $types]);
    }

    // Retornar la lista de procesos
    public function getProcess()
    {
        $processes = $this->documentService->getProcesses();
        return response()->json(['status' => true, 'processes' => $processes]);
    }

    // registrar documento
    public function store(Request $request)
    {
        $document = $this->documentService->storeDocument($request);
        return response()->json(['status' => true, 'document' => $document]);
    }

    // actualizar documento
    public function update(Request $request, string $id)
    {
        $document = $this->documentService->updateDocument($id, $request);
        return response()->json(['status' => true, 'document' => $document]);
    }

    // eliminar documento
    public function destroy($id)
    {
        $document = $this->documentService->deleteDocument($id);
        return response()->json(['status' => true, 'document' => $document]);
    }
}
