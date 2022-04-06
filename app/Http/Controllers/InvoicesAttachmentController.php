<?php

namespace App\Http\Controllers;

use App\invoices_attachment;
use Illuminate\Http\Request;
use App\invoices_attachments;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'file_name' => 'mimes:pdf,jpeg,png,jpg',

            ], [
                'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
            ]);

            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();

            $attachments =  new invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $request->invoice_number;
            $attachments->invoice_id = $request->invoice_id;
            $attachments->Created_by = Auth::user()->name;
            $attachments->save();

            // move pic

            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/'. $requset->id.$request->invoice_number), $imageName);

            session()->flash('Add', 'تم اضافة المرفق بنجاح');
            return back();

    }

    public function show(Request $request, invoices_attachments $invoices_attachment)
    {
        //
    }


    public function edit(Request $request, invoices_attachments $invoices_attachment)
    {
        //
    }


    public function update(Request $request, invoices_attachments $invoices_attachment)
    {
        //
    }


    public function destroy(Request $request,invoices_attachments $invoices_attachment)
    {
        //
    }
}
