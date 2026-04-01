<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;

class DocumentController extends Controller
{
    public function index()
    {
      return view('documents.index', [
        'docs' => Document::all()
      ]);
    }

    public function create()
    {
      return view('documents.create');
    }

    public function store(StoreDocumentRequest $request)
    {
      Document::create($request->validated());
      session()->flash('success', 'Document created successfully.');
      return redirect()->back(201);
    }

    public function show(Document $document)
    {
      return view('documents.index', [
        'doc' => $document
      ]);
    }

    public function edit(Document $document)
    {
      return view('documents.edit', [
        'doc' => $document->load('doctor', 'patient')
      ]);
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
      $document->update($request->validated());
      return redirect()->route('documents.index');
    }

    public function destroy(Document $document)
    {
      $document->delete();
      return redirect()->back(200)->with(session()->flash('success', 'Document deleted successfully.'));
    }
}
