<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Bill_Detail;
use App\Bill_Head;
class SallesController extends Controller
{
    public function index()
    {
        $clients=\App\Client::all();
        $safes=\App\Safe::all();
        $stores=\App\Store::all();
        $items=\App\Item::all();
        $unites=\App\Unite::all();
        
        return view("dashboard.sell.index",compact('clients','stores','items','unites','safes'));
    }
    public function get_report(Request $request)
    {
      // return response()->json($request);
      if ($request->ajax()) {

        $request->validate([
            'qtn' =>"required",
            'item_id'=>"required",
            // 'date'=>"required",
            'unite_id'=>"required",
            'store_id'=>"required",
            'price'  =>"required",
            ]);
        $quantaty = \App\Stock::where("store_id",$request->store_id)->where("item_id",$request->item_id)->first();
        $sup_count_main=\App\Item::where("id",$request->item_id)->first(); 
        $unite_type=\App\Unite::findOrFail($request->unite_id);
                        
          $data=[];
        if ($quantaty) {
          if ($unite_type->type == 0) {
              if ($quantaty->qtn >= ($request->qtn + ($sup_count_main->sup_count_main * ($request->ol != 'undefined') ? $request->ol : 1  )) ) {
                    if ( $sup_count_main->stamp === "Yes") {
                      $item= $request->item_id;
                      $store_id= $request->store_id;
                      $unite_id= $request->unite_id;
                      $qtn= $request->qtn;
                      $price= $request->price;
                      $ott =($price * 15 )/100 ;
                      $tottal = round((($request->price +$ott) * $request->qtn),3);
                      $data['item_id']=$item;
                      $data['qtn']=$qtn;
                      $data['price']=$price;
                      $data['tottal']=$tottal;
                      $data['unite_id']=$unite_id;
                      $data['store_id']=$store_id;
                     $data['item']=\App\Item::findOrFail($request->item_id);
                    $data['unite']=\App\Unite::findOrFail($request->unite_id);

                      // array_push($data,['item'=>$item,'qtn'=>$qtn,'price'=>$price,'tottal'=>$tottal,'unite_id'=>$unite_id,'store_id'=>$store_id]);
                      return response()->json($data);
                    }else {
                      $item= $request->item_id;
                      $store_id= $request->store_id;
                      $unite_id= $request->unite_id;
                      $qtn= $request->qtn;
                      $price= $request->price;
                      $tottal = round((($request->price ) * $request->qtn),3);
                      $data['item_id']=$item;
                      $data['qtn']=$qtn;
                      $data['price']=$price;
                      $data['tottal']=$tottal;
                      $data['unite_id']=$unite_id;
                      $data['store_id']=$store_id;
                     $data['item']=\App\Item::findOrFail($request->item_id);
                    $data['unite']=\App\Unite::findOrFail($request->unite_id);

                      // array_push($data,['item'=>$item,'qtn'=>$qtn,'price'=>$price,'tottal'=>$tottal,'unite_id'=>$unite_id,'store_id'=>$store_id]);
                      return response()->json($data);
                    }
                
                }else {
                  $qtn = "this qtn more than we have";
                  return response()->json([
                    "messege"=>$qtn,
                    "status"=>100,
                    ]);
                }
            }else {
              if ($quantaty->qtn >= (($request->qtn * $sup_count_main->sup_count_main) + (($request->ol !== 'undefined') ? $request->ol : 0  ))) {
                  if ( $sup_count_main->stamp === "Yes") {

                      $item= $request->item_id;
                      $store_id= $request->store_id;
                      $unite_id= $request->unite_id;
                      $qtn= $request->qtn;
                      $price= $request->price;
                      $ott =($price * 15 )/100 ;
                      $tottal = round((($request->price +$ott) * $request->qtn),3);
                      $data['item_id']=$item;
                      $data['qtn']=$qtn;
                      $data['price']=$price;
                      $data['tottal']=$tottal;
                      $data['unite_id']=$unite_id;
                      $data['store_id']=$store_id;
                     $data['item']=\App\Item::findOrFail($request->item_id);
                    $data['unite']=\App\Unite::findOrFail($request->unite_id);

                      // array_push($data,['item'=>$item,'qtn'=>$qtn,'price'=>$price,'tottal'=>$tottal,'unite_id'=>$unite_id,'store_id'=>$store_id]);
                      return response()->json($data);
                      // return view("dashboard.sell.item",compact('item','qtn','price','tottal','unite_id','store_id'));
                  }else {
                    $item= $request->item_id;
                    $store_id= $request->store_id;
                    $unite_id= $request->unite_id;
                    $qtn= $request->qtn;
                    $price= $request->price;
                    // $ott =($price * 15 )/100 ;
                    $tottal = round((($request->price ) * $request->qtn),3);
                    $data['item_id']=$item;
                    $data['qtn']=$qtn;
                    $data['price']=$price;
                    $data['tottal']=$tottal;
                    $data['unite_id']=$unite_id;
                    $data['store_id']=$store_id;
                    $data['item']=\App\Item::findOrFail($request->item_id);
                    $data['unite']=\App\Unite::findOrFail($request->unite_id);

                    // array_push($data,['item'=>$item,'qtn'=>$qtn,'price'=>$price,'tottal'=>$tottal,'unite_id'=>$unite_id,'store_id'=>$store_id]);
                    return response()->json($data);
                     // return view("dashboard.sell.item",compact('item','qtn','price','tottal','unite_id','store_id'));
                  }
                }else {
                  $qtn = "this qtn more than we have";
                  return response()->json([
                    "messege"=>$qtn,
                    "status"=>100,
                    ]);
                }
          }
        
        }else {
          $qtn = "this store dosnt have this item ";
          return response()->json([
            "messege"=>$qtn,
            "status"=>100,
            ]);
        }
      }
     
    }
    public function get_tottal(Request $request)
    {
        $quantaty = \App\Stock::where("store_id",$request->store_id)->where("item_id",$request->item_id)->first();
        $sup_count_main=\App\Item::where("id",$request->item_id)->first(); 
        $unite_type=\App\Unite::findOrFail($request->unite_id);
        
      if ($quantaty) {
      if ($unite_type->type == 0) {
        if ($quantaty->qtn >=  ($request->qtn)) {
            if ( $sup_count_main->stamp === "Yes") {
                $qtn= $request->qtn;
                $price= $request->price;
                $ott =($price * 15 )/100 ;
                $tottal = (($request->price +$ott) * $request->qtn);
                return view("dashboard.sell.tottal",compact('tottal'));
            }else {
              $qtn= $request->qtn;
              $price= $request->price;
              $tottal = (($request->price ) * $request->qtn);
              return view("dashboard.sell.tottal",compact('tottal'));
            }
          }

         }else {
          if ($quantaty->qtn >= ($request->qtn * $sup_count_main->sup_count_main)) {
            if ( $sup_count_main->stamp === "Yes") {
                $qtn= $request->qtn;
                $price= $request->price;
                $ott =($price * 15 )/100 ;
                $tottal = (($request->price +$ott) * $request->qtn);
                return view("dashboard.sell.tottal",compact('tottal'));
            }else {
              $qtn= $request->qtn;
              $price= $request->price;
              $tottal = (($request->price) * $request->qtn);
              return view("dashboard.sell.tottal",compact('tottal'));
            }
          }

        }
      }
    }
    public function get_item(Request $request)
    {
       $items=\App\Stock::where('store_id',$request->store_id)->get();
       $data=[];
       foreach ($items as  $value) {
         $item_name=\App\Item::findOrFail($value->item_id);
         array_push($data,[$item_name->name=>$value->item_id]);
       }
        return response()->json($data);//then sent this data to ajax success
    }
    public function get_unite(Request $request)
    {
       $item=\App\Item::where('id',$request->item_id)->first();
       $main_unite=\App\Unite::findOrFail($item->main_unite);
        $sup_unite=\App\Unite::findOrFail($item->sup_unite);
       $data=[];
       array_push($data,[ $main_unite->name => $main_unite->id],[ $sup_unite->name=>$sup_unite->id]);
        return response()->json($data);//then sent this data to ajax success
    }
    public function get_price(Request $request)
    {
        $unite=$request->unite_id;
        $data=\App\Item::findOrFail($request->id);
        return response()->json($data);//then sent this data to ajax success
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
            "client_id"=>"required",
           
            ]);
            $data=$request->except(['item']);
            $billl=Bill_Head::where("bill_number",$data['bill_number'])->get();
            if (count($billl) > 0) {
                $data="change bill_number plz ";
                 return response()->json($data);
            }else{
              // bill head stroe
                $head=new Bill_Head;
                $head->client_id=$data['client_id'];
                $head->tottal=$data['tottal'];
                $head->paid=$data['paid'];
                $head->bill_number=$data['bill_number'];
                $head->roamin=$data['roamin'];
                $head->date=$data['date'];
                $head->safe_id=$data['safe_id'];
                $head->discount=$data['discount'];
                $head->save();
              // safe    
                $safe=\App\Safe::findOrFail($data['safe_id']);
                $safe->count=$safe->count + $data['tottal'] ;
                $safe->save();
              // save_plus  
                $safe= new \App\Safe_Plus;
                $safe->safe_id=$data['safe_id'];
                $safe->date=$data['date'];
                $safe->kiend='عمليه شراء';
                $safe->count_plus=$data['tottal'];
                $safe->save();
                          
                      foreach ($request->item as  $value) {
                            $qtn =\App\Stock::where("store_id",$value['store_id'])->where("item_id",$value['item_id'])->first();
                            $sup_count_main=\App\Item::where("id",$value["item_id"])->first();
                            $unite_type=\App\Unite::findOrFail($value["unite_id"]);
                            if( $qtn->qtn >= $value["qtn"]){
                                $data['item_id']=$value["item_id"];
                                $data['qtn']=$value["qtn"];
                                $data['price']=$value["price"];
                                $data['tottal']=$value["tottal"];
                                $data['store_id']=$value['store_id'];
                                $data['unite_id']=$value['unite_id'];
                                Bill_Detail::create($data);
                                
                                //stock discount 
                                if ($unite_type->type == 0) {
                                  $qtn->qtn = ($qtn->qtn - $value["qtn"]);
                                  $qtn->save();
                                }else{
                                 
                                  $qtn->qtn = ($qtn->qtn - ($value["qtn"] * $sup_count_main->sup_count_main ));
                                  $qtn->save();
                                }
                               
                            }else {
                                $head_delete=Bill_Head::where("bill_number",$data['bill_number'])->where('date',$data['date'])->first();
                                $head_delete->delete();
                                $data="this qtn more than we have ";
                                return response()->json($data);
                        
                                  }
                          
                               
                      }
                   
            }
           
              
            
           

                    
            
          }
    }
    public function bill_heades_index()
    {
      $backs =[];
        $datas=\App\Bill_Head::all();
        foreach ($datas as  $data) {
         $df= \App\Back::where("bill_number",$data->bill_number)->get();
          if (count($df) > 0) {
            array_push($backs,[$data->client_id=>$data->bill_number]);
          }
        }
        $name=\App\Client::all();
        $safes=\App\Safe::all();
        return view("dashboard.sell.bill_heades_index",compact('datas',"name",'safes','backs'));
    }
    public function bill_details($id)
    {

        $bill_heads=\App\Bill_Detail::where("bill_id",$id)->get();
        $items=\App\Item::all();
        $unites=\App\Unite::all();
        $stores=\App\Store::all();

        
        return view("dashboard.sell.bill_details",compact('bill_heads','items','unites','stores'));
    }
}
