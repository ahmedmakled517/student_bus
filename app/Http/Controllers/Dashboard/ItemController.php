<?php

namespace App\Http\Controllers\Dashboard;

use App\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $items=Item::all();
        $unites=\App\Unite::all();
        return view("dashboard.item.index",compact('items','unites'));
    }

    
    public function create()
    {
        $unites= \App\Unite::all();
        $main_unite= \App\Unite::where('type',0)->get();
        $sup_unite= \App\Unite::where('type',1)->get();
        return view("dashboard.item.create",compact('unites','main_unite','sup_unite'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            'main_unite'=>"required",
            'm_buy_price'=>"required",
            'm_sell_price'=>"required",
            'sup_unite'=>"required",
            'sup_count_main'=>"required",
            's_buy_price'=>"required",
            's_sell_price'=>"required",
        ]);
        Item::create($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.items.index');
    }

    
    

    
    public function edit($id)
    {
        $item=Item::findOrFail($id);
        $unites= \App\Unite::all();
        $main_unite= \App\Unite::where('type',0)->get();
        $sup_unite= \App\Unite::where('type',1)->get();
        return view('dashboard.item.edit',compact('item','unites','main_unite','sup_unite'));
    }

   
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'=>"required",
            'main_unite'=>"required",
            'm_buy_price'=>"required",
            'm_sell_price'=>"required",
            'sup_unite'=>"required",
            'sup_count_main'=>"required",
            's_buy_price'=>"required",
            's_sell_price'=>"required",
        ]);
        $item->update($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.items.index');
    }
    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        session()->flash('success',"deleted success");
        return redirect()->route('dashboard.items.index');
    }
}