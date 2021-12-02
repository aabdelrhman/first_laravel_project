<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\products;
use App\Models\sections;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $invoices = invoices::select()->with('section')->get();
        return view('invoices.invoices' , get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $sections = sections::all();
        return view('invoices\add_invoice' , get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            DB::beginTransaction();
            $invoice_id = invoices::insertGetId([
                'invoice_number' => $request -> invoice_number,
                'invoice_Date' => $request -> invoice_Date,
                'Due_date' => $request -> Due_date,
                'product' => $request -> product,
                'section_id' => $request -> Section,
                'Amount_collection' => $request -> Amount_collection,
                'Amount_Commission' => $request -> Amount_Commission,
                'Discount' => $request -> Discount,
                'Value_VAT' => $request -> Value_VAT,
                'Rate_VAT' => $request -> Rate_VAT,
                'Total' => $request -> Total,
                'Status' => 'غير مدفوعة' ,
                'Value_Status' => 2,
                'note' => $request -> note,
            ]);
            invoices_details::create([
                'invoices_id' => $invoice_id,
                'invoice_number' => $request -> invoice_number,
                'product' => $request -> product,
                'section' => $request -> Section,
                'status' => 'غير مدفوعة',
                'value_status' => 2,
                'remaining_amout' => $request -> Total,
                'note' => $request -> note,
                'user' => Auth::user()->name,
            ]);
            if($request->has('pic')){
                $filename = SaveImage($request -> pic , 'images/');

                invoice_attachments::create([
                    'file_name' => $filename ,
                    'invoice_number' => $request -> invoice_number ,
                    'created_by' => Auth::user()->name ,
                    'invoice_id' => $invoice_id ,
                ]);
            }
            DB::commit();
            $user = User::get();
            $invoices = invoices::find($invoice_id);
            Notification::send($user, new AddInvoice($invoices));
            return redirect() -> route('invoices.index')->with('success' , 'تم أضافة الفاتورة بنجاح');
        } catch (\Throwable $th) {
            DB::rollback();
            // return $th ;
            return redirect() -> route('invoices.index')->with('error' , 'هناك خطأ ما يرجى العودة للمبرمج');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($invoices_id){
        $found = invoices::find($invoices_id);
        if(!$found){
            return redirect() -> route('invoices.index')->with('error' , 'لا يوجد فاتورة بهذا الرقم');
        }
        $invoices = invoices::with('details' , 'attachment' , 'section')->find($invoices_id);
        return view('invoices.show_invoice' , get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $invoice = invoices::with('section')->find($id);
        $sections = sections::all();
        if(!$invoice){
            return redirect() -> route('invoices.index')->with('error' , 'لا يوجد فاتورة بهذا الأسم');
        }
        return view('invoices.edit_invoice' , get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        try {
            $invoice = invoices::findOrFail($request -> id );
            $invoice -> update([
                'invoice_number' => $request->invoice_number,
                'invoice_Date' => $request->invoice_Date,
                'Due_date' => $request->Due_date,
                'product' => $request->product,
                'section_id' => $request->Section,
                'Amount_collection' => $request->Amount_collection,
                'Amount_Commission' => $request->Amount_Commission,
                'Discount' => $request->Discount,
                'Value_VAT' => $request->Value_VAT,
                'Rate_VAT' => $request->Rate_VAT,
                'Total' => $request->Total,
                'note' => $request->note,
            ]);
            return redirect() -> route('invoices.index')->with('success' , 'تم التحديث بنجاح');
        } catch (\Throwable $th) {
            return redirect() -> route('invoices.index')->with('error' , 'هناك خطأ ما يرجى العودة للمبرمج');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request){
        try {
            $invoice = invoices::find($request -> id);
            $attachments = invoice_attachments::where('invoice_id' , $request -> id) -> get();
            if(!$invoice){
                return redirect() -> route('invoices.index')->with('error' , 'لا يوجد فاتورة بهذا الرقم');
            }
            if(!$request->has('page_id')){
                if($attachments ->count() > 0 ){
                    foreach($attachments as $attachment){
                        Storage::disk('images')->delete('/'.$attachment -> file_name);
                    }
                }
                $invoice -> forceDelete();
                return redirect() -> route('invoices.index')->with('success' , 'تم الحذف بنجاح');
            }else{
                $invoice -> delete();
                return redirect() -> route('archive_invoice')->with('success' , 'تم نقل الفاتورة الى الأرشيف');
            }
        } catch (\Throwable $th) {
            // return $th ;
            return redirect() -> route('invoices.index')->with('error' , 'هناك خطأ ما يرجى العودة للمبرمج');
        }
    }

    public function getproducts($id){
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    public function show_status($id){
        $invoice = invoices::find($id);
        if(!$invoice){
            return redirect() -> route('invoices.index')->with('error' , 'لا يوجد فاتورة بهذا الرقم');
        }
        return view('invoices.update_status' , get_defined_vars());
    }

    public function update_status($id , request $request){
        try {
            $invoice = invoices::find($id);
            if(!$invoice){
                return redirect() -> route('invoices.index')->with('error' , 'لا يوجد فاتورة بهذا الرقم');
            }
            $status = "";
            if($request -> new_status == 1){
                $status = "مدفوعة" ;
                DB::beginTransaction();
                $invoice -> update([
                    'Status' => $status,
                    'Value_Status' => $request -> new_status,
                    'Payment_Date' => $request ->Payment_Date,
                ]);
                invoices_details::create([
                    'invoices_id' => $request -> id,
                    'invoice_number' => $invoice -> invoice_number,
                    'product' => $invoice -> product,
                    'section' => $invoice -> section,
                    'status' => $status,
                    'value_status' => $request -> new_status,
                    'amount_paid' => $invoice -> Total,
                    'Payment_Date' => $request -> Payment_Date,
                    'note' => $invoice -> note,
                    'user' => Auth::user()->name,
                ]);
            }else{
                $status = "مدفوعة جزئيا" ;
                DB::beginTransaction();
                $invoice -> update([
                    'Status' => $status,
                    'Total' => $request -> remaining,
                    'Value_Status' => $request -> new_status,
                    'Payment_Date' => $request ->Payment_Date,
                ]);
                invoices_details::create([
                    'invoices_id' => $request -> id,
                    'invoice_number' => $invoice -> invoice_number,
                    'product' => $invoice -> product,
                    'section' => $invoice -> section,
                    'status' => $status,
                    'value_status' => $request -> new_status,
                    'amount_paid' => $request -> paid,
                    'remaining_amout' => $request -> remaining,
                    'Payment_Date' => $request -> Payment_Date,
                    'note' => $invoice -> note,
                    'user' => Auth::user()->name,
                ]);
            }
            DB::commit();
            return redirect() -> route('invoices.index')->with('success' , 'تم تحديث الجالة بنجاح');
            return $request ;
        } catch (\Throwable $th) {
            DB::rollback();
            return $th ;
            // return redirect() -> route('invoices.index')->with('error' , 'هناك خطأ ما يرجى العودة للمبرمج');
        }
    }

    public function paid_invoice(){
        $Value_Status = 1 ;
        $invoices = invoices::where('Value_Status' , $Value_Status)->get();
        return view('invoices.paid_invoice' , get_defined_vars());
    }

    public function none_paid_invoice(){
        $Value_Status = 2 ;
        $invoices = invoices::where('Value_Status' , $Value_Status)->get();
        return view('invoices.paid_invoice' , get_defined_vars());
    }

    public function part_paid_invoice(){
        $Value_Status = 3 ;
        $invoices = invoices::where('Value_Status' , $Value_Status)->get();
        return view('invoices.paid_invoice' , get_defined_vars());
    }

    public function archive_invoice(){
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.archive_invoice' , get_defined_vars());
    }

    public function return_archive_invoice(Request $request){
        invoices::withTrashed()->where('id' , $request->id)->restore();
        return redirect()->route('invoices.index');
    }

    public function delete_archive_invoice(Request $request){
        $invoice = invoices::withTrashed()->where('id' , $request->id)->first();
        $invoice->forceDelete();
        return redirect()->route('invoices.index')->with('success' , 'تم حذف الفاتورة بنجاح');
    }

    public function print_invoice($id){
        $invoices = invoices::where('id' , $id)->first();
        return view('invoices.Print_invoice', get_defined_vars());
    }

    public function markread(){
        $notification = auth()->user()->unreadNotifications;
        if($notification){
            $notification ->markAsRead();
            return back();
        }
    }

    public function markThisRead($id){
        $notification = auth()->user()->unreadNotifications->find($id);
        $notification ->markAsRead();
        return redirect() ->route('invoices.show', $notification->data['id']);
    }
}
