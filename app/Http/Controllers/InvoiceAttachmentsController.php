<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceAttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $filename = SaveImage($request -> file , 'images/');

            invoice_attachments::create([
                'file_name' => $filename ,
                'invoice_number' => $request -> invoice_number ,
                'created_by' => Auth::user()->name ,
                'invoice_id' => $request -> invoice_id ,
            ]);
            return redirect() -> route('invoices.index')->with('success' , 'تم أضافة الملحق بنجاح');
        } catch (\Throwable $th) {
            return redirect() -> route('invoices.index')->with('error' , 'هناك خط ما يرجى العودة للمبرمج');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $invoice_attachments = invoice_attachments::find($request -> id_file);
        if(!$invoice_attachments){
            return redirect() -> route('invoices.index')->with('error' , 'لا يوجد ملحق بهذا الرقم');
        }
        $invoice_attachments -> delete();
        Storage::disk('images')->delete('/'.$request -> file_name);
        return redirect() -> route('invoices.index')->with('success' , 'تم حذف الملحق بنجاح');
    }
    public function show_file($file_name){
        $files = Storage::disk('images')->getDriver()->getAdapter()->applyPathPrefix('/'.$file_name);
        return response()->file($files);
    }

    public function download($file_name){
        $file = Storage::disk('images')->getDriver()->getAdapter()->applyPathPrefix('/'.$file_name);
        return response()->download($file);
    }
}
