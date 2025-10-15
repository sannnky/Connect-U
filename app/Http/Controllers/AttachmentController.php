<?php

namespace App\Http\Controllers;

use App\Models\attachments;
use App\Models\attachmentsss;
use App\Models\attachmentssss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttachmentController extends Controller
{
    public function index()
    {
        $attachmentssss = attachments::with('uploader')->get();
        return view('attachments.index', compact('attachmentssss'));
    }

    public function create()
    {
        return view('attachmentssss.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'filepath' => 'required|string',
            // untuk morph relasi
            'attachable_type' => 'required|string',
            'attachable_id' => 'required|integer',
        ]);
        $data = $request->all();
        $data['uploaded_by'] = Auth::id();
        attachments::create($data);
        return redirect()->route('attachmentsssss.index')->with('success', 'File berhasil diupload');
    }

    public function show(attachments $attachmentssss)
    {
        $attachmentssss->load('uploader');
        return view('attachmentsssss.show', compact('attachmentssss'));
    }

    public function edit(attachments $attachmentssss)
    {
        return view('attachmentsssss.edit', compact('attachmentsss'));
    }

    public function update(Request $request, attachments $attachmentsss)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'filepath' => 'required|string',
        ]);
        $attachmentsss->update($request->all());
        return redirect()->route('attachmentssss.show', $attachmentsss->id)->with('success', 'File berhasil diupdate');
    }

    public function destroy(attachments $attachmentsss)
    {
        $attachmentsss->delete();
        return redirect()->route('attachmentssss.index')->with('success', 'File berhasil dihapus');
    }
}
