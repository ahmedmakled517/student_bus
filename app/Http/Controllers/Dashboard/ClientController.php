<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Client;

class ClientController extends Controller
{
   
    public function index()
    {
        $clients=Client::all();
        return view("dashboard.client.index",compact('clients'));
    }

   
    public function create()
    {
        return view("dashboard.client.create");
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
        ]);
        Client::create($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.clients.index');
    }

   
    

   
    public function edit($id)
    {
        $client=Client::findOrFail($id);
        return view('dashboard.client.edit',compact('client'));
    }

    
    public function update(Request $request,Client $client)
    {
        $request->validate([
            'name'=>"required",
           
        ]);
        $client->update($request->all());
        session()->flash('success',"added success");
        return redirect()->route('dashboard.clients.index');
    }

    
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        session()->flash('success',"deleted success");
        return redirect()->route('dashboard.clients.index');
    }
}
