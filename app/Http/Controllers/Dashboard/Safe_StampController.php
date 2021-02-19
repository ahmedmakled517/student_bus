<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Safe_StampController extends Controller
{
    public function safe_index()
    {
        $safes = \App\Safe::all();
        return view("dashboard.safe_stamp.index",compact('safes'));
    }
    public function get_report(Request $request)
    {
            if ($request->ajax()) {
                $request->validate([
                    'date_from'=>"required",
                    'date_to'=>"required",
                    'safe_id'=>"required",
                ]);
                  $stamps=\App\Safe_Plus::where("safe_id",$request->safe_id)->where("date", ">=",$request->date_from)->where("date", "<=",$request->date_to)->get();
                  $total=\App\Safe::findOrFail($request->safe_id);
                  return view("dashboard.safe_stamp.report",compact('stamps',"total"));
            }
    }
}
