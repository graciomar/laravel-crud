<?php

namespace App\Http\Controllers;

use App\Crud;
use Illuminate\Http\Request;
use App\Http\Requests\CrudRequest;

class CrudController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $cruds = [];
        $listCrud = new \App\Model\Crud();
        $listCrud = $listCrud->orderBy('id', 'desc');

        $listCrud = $listCrud->paginate(10);

        if(!is_null($listCrud)){
            $cruds = $listCrud;
        }

        return view('crud.index', compact('cruds') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CrudRequest $request)
    {
        try{
            $crud = new \App\Model\Crud();
            
            $crud->name = $request->name;
            $crud->phone = $request->phone;
            $crud->email = $request->email;
            $crud->address = $request->address;

            $crud = $crud->save();

            if(!is_null($crud)){
                \Session::flash('message', [
                    'msg'=>'Register stored with success.',
                    'class'=>'success'
                ]);
            }else{
               \Session::flash('message', [
                    'msg'=>'internal error.',
                    'class'=>'danger'
                ]); 
            }
        }catch(\Excetion $e){
            \Session::flash('message', [
                'msg'=>'internal error.',
                'class'=>'danger'
            ]);
        }
        return redirect()->route('crud.index');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Crud  $crud
    * @return \Illuminate\Http\Response
    */
    public function show(Crud $crud)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Crud  $crud
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $objCrud = new \App\Model\Crud();
        $crud = $objCrud::find($id);
        if(!is_null($crud)){
            return view('crud.edit', compact('crud'));
        }else{
            return redirect()->route('crud.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(CrudRequest $request)
    {
        try{
            $objCrud = new \App\Model\Crud();
            $crud = $objCrud::find($request->id);

            $crud->name = $request->name;
            $crud->phone = $request->phone;
            $crud->address = $request->address;

            $crud = $crud->update();

            if(!is_null($crud)){
                \Session::flash('message', [
                    'msg'=>'Register updated with success.',
                    'class'=>'success'
                ]);
            }else{
               \Session::flash('message', [
                    'msg'=>'internal error.',
                    'class'=>'danger'
                ]); 
            }
        }catch(\Excetion $e){
            \Session::flash('message', [
                'msg'=>'internal error.',
                'class'=>'danger'
            ]);
        }
        return redirect()->route('crud.index');

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Crud  $crud
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        return "route destroy:".$id;
    }
}
