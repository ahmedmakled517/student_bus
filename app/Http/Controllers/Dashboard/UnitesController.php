<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Unite;

class UnitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unites = Unite::all();
        return view("dashboard.unite.index",compact('unites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.unite.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            'type'=>"required",
        ]);
        Unite::create($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.unites.index');
    }

    
    public function edit($id)
    {
        $unite=Unite::findOrFail($id);
        return view("dashboard.unite.edit",compact('unite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Unite $unite)
    {
        $request->validate([
            'name'=>"required",
            'type'=>"required",
        ]);
        $unite->update($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.unites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unite::findOrFail($id)->delete();
        session()->flash('success',"deleted success");
        return redirect()->route('dashboard.unites.index');
    }
}
