<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Bill_HeadController extends Controller
{  
     public function index()
    {
        $heades=Bill_Head::all();
        return view("dashboard.selles.head.index",compact('heades'));
    }

   
    public function create()
    {
        $clients=\App\Client::all();
        $safes=\App\Safe::all();
        return view("dashboard.selles.head.create",compact('clients','safes'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
        ]);
        Bill_Head::create($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.heads.index');
    }

   
    

   
    public function edit($id)
    {
        $head=Bill_Head::findOrFail($id);
        return view('dashboard.selles.head.edit',compact('head'));
    }

    
    public function update(Request $request,Bill_Head $head)
    {
        $request->validate([
            'name'=>"required",
           
        ]);
        $head->update($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.heads.index');
    }

    
    public function destroy($id)
    {
        Bill_Head::findOrFail($id)->delete();
        session()->flash('success',"deleted success");
        return redirect()->route('dashboard.heads.index');
    }
}
