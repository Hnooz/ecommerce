<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Department;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.departments.index', ['title' => trans('admin.departments')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('admin.departments.create', ['title' => trans('admin.add')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validate(request(),
        [
           'dep_name_ar'    => 'required',
           'dep_name_en'    => 'required',
           'parent_id'      => 'sometimes|nullable|numeric',
           'icon'           => 'sometimes|nullable',
           'description'    => 'sometimes|nullable',
           'keyword'        => 'sometimes|nullable',
        ], [] , [
            'dep_name_ar'   => trans('admin.dep_name_ar'),
            'dep_name_en'   => trans('admin.dep_name_en'),
            'parent_id'     => trans('admin.parent_id'),
            'icon'          => trans('admin.dep_icon'),
            'description'   => trans('admin.description'),
            'keyword'       => trans('admin.keyword'),
          
        ]);
        
    //    dd($data);
        Department::create($data);
        
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('departments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments =   Department::find($id);
        $title = trans('admin.edit');

        return view('admin.departments.edit', compact('departments', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
        [
           'dep_name_ar'    => 'required',
           'dep_name_en'    => 'required',
            'parent_id'     => 'sometimes|nullable|numeric',
            'icon'          => 'sometimes|nullable',
            'description'   => 'sometimes|nullable',
            'keyword'       => 'sometimes|nullable',
        ], [] , [
            'dep_name_ar'   => trans('admin.dep_name_ar'),
            'dep_name_en'   => trans('admin.dep_name_en'),
            'parent_id'     => trans('admin.parent_id'),
            'icon'          => trans('admin.icon'),
            'description'   => trans('admin.description'),
            'keyword'       => trans('admin.keyword'),
          
        ]);
        
       
        Department::where('id', $id)->update($data);

        session()->flash('success', trans('admin.update_added'));
        return redirect(aurl('departments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departments = Department::find($id);
       
        $departments->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('departments'));
    }

    public function multi_delete() 
    {
        if(is_array(request('item')))
        {
            forEach(request('item') as $id)
            {
                $departments = Department::find($id);
               
                $departments->delete();
            }
        } else {
            $departments = Department::find(request('item'));
           
            $departments->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('departments'));
        
    }
}
