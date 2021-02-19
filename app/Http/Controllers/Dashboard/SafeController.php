<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Safe;

class SafeController extends Controller
{
    public function index()
    {
        $safes=Safe::all();
        return view("dashboard.safe.index",compact('safes'));
    }

    
    public function create()
    {
        return view("dashboard.safe.create");
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            'count'=>"required"

        ]);
        Safe::create($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.safes.index');
    }

    
    

    
    public function edit($id)
    {
        $safe=Safe::findOrFail($id);
       
        return view('dashboard.safe.edit',compact('safe'));
    }

   
    public function update(Request $request,Safe $safe)
    {
        $request->validate([
            'name'=>"required",
            'count'=>"required"
        ]);
        $safe->update($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.safes.index');
    }

    
    public function destroy($id)
    {
        Safe::findOrFail($id)->delete();
        session()->flash('success',"deleted success");
        return redirect()->route('dashboard.safes.index');
    }
}
