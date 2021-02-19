<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Clien_AcountController extends Controller
{
    public function index()
    {
        $clients=\App\Client::all();
        return view("dashboard.client_acount.index",compact('clients'));
    }
    public function get_report(Request $request)
    {
            if ($request->ajax()) {
                if ($request->client_id != "--chose client --") {
                    $stamps=\App\Bill_Head::where("client_id",$request->client_id)->where("date", ">=",$request->date_from)->where("date", "<=",$request->date_to)->get();
                    $tottal=0;
                     $client_name=\App\Client::findOrFail($request->client_id);
                    foreach ($stamps as  $stamp) {
                       $tottal += $stamp->tottal - $stamp->paid ;
                    }
                     return view("dashboard.client_acount.report",compact('stamps',"tottal",'client_name'));
                }else {
                    $stamps=\App\Bill_Head::where("date", ">=",$request->date_from)->where("date", "<=",$request->date_to)->get();
                    $client_name=\App\Client::all();
                    return view("dashboard.client_acount.report_else",compact('stamps','client_name'));
                }
            }
    }
}
