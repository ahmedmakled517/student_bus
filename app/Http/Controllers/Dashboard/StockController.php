<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Stock;


class StockController extends Controller
{
  
    public function index()
    {
        $stockes=Stock::all();
        $stores=\App\Store::all();
        $items=\App\Item::all();
        return view("dashboard.stock.index",compact('stockes',"stores",'items'));
    }

    
    public function create()
    {
        $stores=\App\Store::all();
        $items=\App\Item::all();
        return view("dashboard.stock.create",compact('items','stores'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'store_id'=>"required",
            'item_id'=>"required",
            'qtn'=>"required",
        ]);
        Stock::create($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.stockes.index');
    }

    
    

    
    public function edit($id)
    {
        $stock=Stock::findOrFail($id);
        $stor=\App\Store::all();
        $items=\App\Item::all();
        return view('dashboard.stock.edit',compact('stock','stor','items'));
    }

   
    public function update(Request $request,$id)
    {
        $request->validate([
            'store_id'=>"required",
            'item_id'=>"required",
            'qtn'=>"required",
        ]);
        $stock=Stock::findOrFail($id);
        $stock->store_id=$request->store_id;
        $stock->item_id=$request->item_id;
        $stock->qtn=$request->qtn;
        $stock->save();
        session()->flash('success',"updated success");
        return redirect()->route('dashboard.stockes.index');
    }

    
    public function destroy($id)
    {
        Stock::findOrFail($id)->delete();
        session()->flash('success',"deleted success");
        return redirect()->route('dashboard.stockes.index');
    }
}
