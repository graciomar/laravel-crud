<?php

namespace App\Http\Controllers;

use App\Crud;
use Illuminate\Http\Request;

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
        return "route create";
        //return view('crud.index');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
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
        return "route edit:".$id;
        //return view('crud.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crud $crud)
    {
        //
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
