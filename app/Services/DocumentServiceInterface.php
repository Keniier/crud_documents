<?php

namespace App\Services;

use Illuminate\Http\Request;

interface DocumentServiceInterface
{
    public function getTypes();

    public function getProcesses();

    public function getDocuments();
    
    public function getDocumentById($id);

    public function storeDocument(Request $request);

    public function updateDocument($id, Request $request);
    
    public function deleteDocument($id);
}