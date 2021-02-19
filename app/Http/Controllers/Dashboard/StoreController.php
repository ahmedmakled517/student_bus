<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;

class StoreController extends Controller
{
   
    public function index()
    {
        $stores=Store::all();
        return view("dashboard.store.index",compact('stores'));
    }

    
    public function create()
    {
        return view("dashboard.store.create");
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
        ]);
        Store::create($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.stores.index');
    }

    
    

    
    public function edit($id)
    {
        $store=Store::findOrFail($id);
        return view('dashboard.store.edit',compact('store'));
    }

   
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name'=>"required",
           
        ]);
        $store->update($request->all());
        session()->flash('success',"updated success");
        return redirect()->route('dashboard.stores.index');
    }

    
    public function destroy($id)
    {
        Store::findOrFail($id)->delete();
        session()->flash('success',"deleted success");
        return redirect()->route('dashboard.stores.index');
    }
}
