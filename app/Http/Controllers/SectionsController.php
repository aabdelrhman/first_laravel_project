<?php

namespace App\Http\Controllers;

use App\Http\Requests\sectoinrequest;
use App\Models\sections;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.section' , get_defined_vars());
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
    public function store(sectoinrequest $request)
    {
        $check_record =  sections::where('section_name' , '='  , $request['section_name'])->exists();
        if($check_record){
            return redirect()->route('section.index')->with('error' , 'هذا القسم مسجل بالفعل');
        }
        else{
            sections::create([
                'section_name' => $request->section_name,
                'description' => $request->section_description,
                'Created_by' => Auth::user()->name,
            ]);
            return redirect()->route('section.index')->with('success' , 'تم حفظ القسم بنجاح');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(sectoinrequest $request)
    {
        $id = $request->id ;
        $section = sections::find($id);
        try {
            if(!$section){
                return redirect()->route('section.index')->with('error' , 'هذا القسم غير موجود');
            }else{
                $section -> update($request->except('_token'));
                return redirect()->route('section.index')->with('success' , 'تم التحديث بنجاح');
            }
        } catch (Exception $ex) {
            return redirect()->route('section.index')->with('error' , 'يوجد مشكلة حاول في وقت لاحق');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id ;
        $section = sections::find($id);
        try {
            if(!$section){
                return redirect()->route('section.index')->with('error' , 'هذا القسم غير موجود');
            }else{
                $section -> delete();
                return redirect()->route('section.index')->with('success' , 'تم حذف القسم بنجاح');
            }
        } catch (Exception $ex) {
            return redirect()->route('section.index')->with('error' , 'يوجد مشكلة حاول في وقت لاحق');
        }
    }
}
