<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\sections;
use Illuminate\Http\Request;

class Invoice_Report extends Controller
{
    public function index(){
        return view('reports.invoices_report');
    }

    public function search_invoices(Request $request){
        $rdio = $request->rdio;
 // في حالة البحث بنوع الفاتورة
    if ($rdio == 1) {
 // في حالة عدم تحديد تاريخ
        if ($request->type && $request->start_at =='' && $request->end_at =='') {
            if($request->type == 'الكل'){
                $invoices = invoices::all();
            }else{
                $invoices = invoices::select('*')->where('Status','=',$request->type)->get();
            }
           $type = $request->type;
           return view('reports.invoices_report',compact('type'))->withDetails($invoices);
        }
        // في حالة تحديد تاريخ استحقاق
        else {

          $start_at = date($request->start_at);
          $end_at = date($request->end_at);
          $type = $request->type;

          $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
          return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);

        }
    }
//====================================================================
// في البحث برقم الفاتورة
        else {
            $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            return view('reports.invoices_report')->withDetails($invoices);
        }
    }

    public function show_custmer_report(){
        $sections = sections::all();
        return view('reports.customers_report' , get_defined_vars());
    }

    public function search_custmer(Request $request){
        if(!$request->Section =="" && !$request->product =="" && !$request->start_at =="" && !$request->end_at == ""){
            $start_at = $request->start_at;
            $end_at = $request->end_at;
            $sections = sections::all();
            $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])
                                ->where('section_id' , $request->Section)
                                ->where('product' , $request->product)->get();
            return view('reports.customers_report' , get_defined_vars());
        }else{
            $sections = sections::all();
            $invoices = invoices::where('section_id' , $request->Section)
                                ->where('product' , $request->product)->get();
            return view('reports.customers_report' , get_defined_vars());
        }
    }

}
