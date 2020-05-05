<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CrudRequest;

class CrudController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $registers = [];
        $registersArray = [];
        $newCrud = new \App\Model\Crud();
        $listRegisters = $newCrud->orderBy('id', 'desc');

        if(!empty($request->codeFilter)){
            $registersArray['codeFilter'] = $request->codeFilter;
            $listRegisters = $listRegisters->where('id', $request->codeFilter );
        }

        if(!empty($request->nameFilter)){
            $registersArray['nameFilter'] = $request->nameFilter;
            $listRegisters = $listRegisters->where('name', 'LIKE', '%'.$request->nameFilter.'%' );
        }

        if(!empty($request->emailFilter)){
            $registersArray['emailFilter'] = $request->emailFilter;
            $listRegisters = $listRegisters->where('email', 'LIKE', '%'.$request->emailFilter.'%' );
        }

        if(!empty($request->addressFilter)){
            $registersArray['addressFilter'] = $request->addressFilter;
            $listRegisters = $listRegisters->where('address', 'LIKE', '%'.$request->addressFilter.'%' );
        }

        $listRegisters = $listRegisters->paginate(10)->appends($registersArray);

        if(!is_null($listRegisters)){
            $registers = $listRegisters;
        }

        return view('crud.index', compact('registers', 'request') );
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
            
            if(!is_null($crud->where('email', $request->email)->first())){
            	\Session::flash('message', [
	                'msg'=>'This email already exists.',
	                'class'=>'danger'
            	]);
            	return redirect()->back();
            }

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
        }catch(\Exception $e){
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
        }catch(\Exception $e){
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
    	$objCrud = new \App\Model\Crud();
        $crud = $objCrud::find($id);

        $delete = $crud->delete();

        if($delete){
            \Session::flash('message', [
                'msg'=>'Register deleted with success.',
                'class'=>'success'
            ]);
        }else{
           \Session::flash('message', [
                'msg'=>'internal error.',
                'class'=>'danger'
            ]); 
        }

        return redirect()->route('crud.index');
    }
}
