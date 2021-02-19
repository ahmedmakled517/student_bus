<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackController extends Controller
{
    public function index()
    {
        $bills=\App\Bill_Head::all();
        return view("dashboard.back.index",compact("bills"));
    }
    public function get_data_head(Request $request)
    {
        if ($request->ajax()) {
            $bill_found=\App\Back::where("bill_number",$request->bill_number)->get();
            if (count($bill_found) >0) {
                $data= "this bill number have backs before";
                return response()->json([
                    "messege"=>$data,
                    "status"=>100
                    ]);
            }else{
            $data=\App\Bill_Head::where("bill_number",$request->bill_number)->first();
            $data['detail']=\App\Bill_Detail::where("bill_id",$request->bill_number)->get();
            $data['client_name']=\App\Client::findOrFail($data->client_id);
            $data['safe_name']=\App\Safe::findOrFail($data->safe_id);
            $d=[];
                foreach ( $data['detail'] as  $value) {
                   $ff =\App\Item::where("id",$value->item_id)->first();
                   $dd =\App\unite::where("id",$value->unite_id)->first();
                   $nn =\App\Store::where("id",$value->store_id)->first();
                   array_push($d,['item_id'=>$ff->id,"item_name"=>$ff->name,"unite_id"=>$dd->id,"unite_name"=>$dd->name,"store_id"=>$nn->id,"store_name"=>$nn->name]);
                }
            $data['de']=$d;
            return response()->json($data);
            }
        }
    }
    public function save_data(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'bill_number' =>"required",
                'paid'        =>"required",
                'roamin'      =>"required",
                'tottal'      =>"required",
                'safe_id'     =>"required",
                'bill_id'     =>"required",
                "item" => "present|array",
                "item.*.item_id" => "required",
                "item.*.qtn" => "required",
                "item.*.price" => "required",
                "item.*.tottal" => "required",
                "item.*.store_id" => "required",
                "item.*.unite_id" => "required",
                "date"=>"required",
                // "client_id"=>"required",
                "discount"=>"required",
                "old_roamin"=>"required",
               
                ]);

            $data=$request->except(['item']);
            $bill_found=\App\Back::where("bill_number",$data['bill_number'])->get();
            if (count($bill_found) >0) {
                $data= "this bill number have backs before";
                return response()->json([
                    "messege"=>$data,
                    "status"=>100
                    ]);
            }else{
               
                $billl=\App\Bill_Head::where("bill_number",$data['bill_number'])->first();
                
                  // bill head stroe
                    $billl->tottal=$data['new_tottal'];
                    $billl->paid=$data['paid'];
                    $billl->roamin=$data['roamin'];
                    $billl->date=$data['date'];
                    $billl->discount=$data['discount'];
                    $billl->save();
                  // safe    
                    $safe=\App\Safe::findOrFail($data['safe_id']);
                    $safe->count=$safe->count - $data['mony_return'] ;
                    $safe->save();
                  // safe_plus
                    $safe= new \App\Safe_Plus;
                    $safe->safe_id=$data['safe_id'];
                    $safe->date=$data['date'];
                    $safe->kiend='عمليه ارجاع منتج';
                    $safe->count_dis=$data['mony_return'];
                    $safe->save();
                              
                          foreach ($request->item as  $value) {
                                $qtn =\App\Stock::where("store_id",$value['store_id'])->where("item_id",$value['item_id'])->first();
                                $detail=\App\Bill_Detail::where("bill_id",$data['bill_number'])->where("item_id",$value["item_id"])->where("store_id",$value["store_id"])->where("unite_id",$value["unite_id"])->first();
                                $sup_count_main=\App\Item::where("id",$value["item_id"])->first();
                                $unite_type=\App\Unite::findOrFail($value["unite_id"]);
                                $data['item_id']=$value["item_id"];
                                    $data['qtn']=$value["qtn"];
                                    $data['price']=$value["price"];
                                    $data['tottal']=$value["tottal"];
                                    $data['store_id']=$value['store_id'];
                                    $data['unite_id']=$value['unite_id'];
                                    \App\Back::create($data);
                                   
                                //stock plus 
                                    if ($unite_type->type == 0) {
                                        $qtn->qtn = ($qtn->qtn + ($detail->qtn - $value["qtn"]));
                                        $qtn->save();
                                    }else{
                                    
                                    $qtn->qtn = ($qtn->qtn + ( ($detail->qtn * $sup_count_main->sup_count_main )   -  ($value["qtn"] * $sup_count_main->sup_count_main )));
                                    $qtn->save();
                                  }
                              
                                   
                          }
                       
                
                        }
        }
    }
    public function back_details($id)
    {

        $bill_heads=\App\Back::where("bill_number",$id)->get();
        $items=\App\Item::all();
        $unites=\App\Unite::all();
        $stores=\App\Store::all();

        
        return view("dashboard.back.bill_details",compact('bill_heads','items','unites','stores'));
    }
}
