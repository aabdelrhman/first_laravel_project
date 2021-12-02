<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\products;
use App\Models\sections;
use Exception;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::all();
        $sections = sections::all();
        return view('products.product' , get_defined_vars());
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
    public function store(ProductRequest $request)
    {
        try {
            products::create([
                'product_name' => $request -> product_name,
                'description' => $request -> product_description,
                'section_id' => $request -> section_id,
            ]);
            return redirect() -> route('product.index')->with('success' , 'تم أدخال المنتج بنجاح');
        } catch (Exception $ex) {
            return redirect() -> route('product.index')->with('error' , 'يوجد مشكلة في حفظ المنتج');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $section_id = sections::where('section_name' , $request -> section_name)->first()->id;
            $product = products::find($request -> pro_id);
            if(!$product){
                return redirect() -> route('product.index') -> with('error' , 'هذا المنتج ليس موجود في قاعدة البيانات');
            }else{
                $product -> update([
                    'product_name' => $request -> Product_name,
                    'description' => $request -> description,
                    'section_id' => $section_id,
                ]);
                return redirect() -> route('product.index') -> with('success' , 'تم تحديث المنتج بنجاح');
            }
        } catch (Exception $ex) {
            return redirect() -> route('product.index') -> with('error' , 'حدث خطأ ما يرجى اعادة المحاولة مرة اخري');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $product = products::find($request -> pro_id);
            if(!$product){
                return redirect() -> route('product.index') -> with('error' , 'هذا المنتج ليس موجود في قاعدة البيانات');
            }else{
                $product -> delete();
                return redirect() -> route('product.index') -> with('success' , 'تم حذف المنتج بنجاح');
            }
        } catch (Exception $ex) {
            return redirect() -> route('product.index') -> with('error' , 'حدث خطأ ما يرجى اعادة المحاولة مرة اخري');
        }
    }
}
