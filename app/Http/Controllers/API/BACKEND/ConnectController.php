<?php

namespace App\Http\Controllers\API\BACKEND;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Connect;
use App\Models\DataCounts;

class ConnectController extends Controller
{
    public function storeConnect(Request $request){
        $this->validate($request, [
            'buyer_id' => 'required',
            'partner_code' => 'required|max:8',
            'seller_id' => 'required',
            'service_end' => 'required|date',
            'service_start' => 'required|date',
        ],[
            'buyer_id.required' => 'The buyer field is required.',
            'seller_id.required' => 'The seller field is required.'
        ]);

        if(count($request->buyer_id) > 0){
            // for ($x = 0; $x < count($request->buyer_id); $x++) {
                $checkExist = Connect::where('seller_id',$request->seller_id['seller_id'])->where('buyer_id', $request->buyer_id['buyer_id'])->count();
               
                if($checkExist > 0){
                    return response()->json([
                        'success' => false,
                        'message' => $request->buyer_id['name'].' is already added for '.$request->seller_id['name']
                    ]);
                }

                Connect::create([
                    'seller_id' => $request->seller_id['seller_id'],
                    'buyer_id' => $request->buyer_id['buyer_id'],
                    // 'buyer_id' => $request->buyer_id[$x]['buyer_id'],
                    'partner_code' => $request->partner_code,
                    'service_start' => $request->service_start,
                    'service_end' => $request->service_end,
                ]);
            //   } 
        }

        return response()->json([
            'success' => true,
            'message' => 'Connected successful.'
        ]);
    }

    public function getConnect(Request $request){
        $q = Connect::query();
        $sort_by = $request->sort_by;
        $sort_type = $request->sort_type;
        $per_page = $request->per_page == null ? 10 : $request->per_page;

        if(!is_null($request->search_buyer_name)){
            $q->whereHas('buyer_list', function ($qr) use ($request){
                $qr->where('name', 'like', "%{$request->search_buyer_name}%");
            });
        }

        if(!is_null($request->search_seller_name)){
            $q->whereHas('seller_list', function ($qr) use ($request){
                $qr->where('name', 'like', "%{$request->search_seller_name}%");
            });
        }

        if(!is_null($request->search_partner_code)){
            $q->where('partner_code', 'like', "%{$request->search_partner_code}%");
        }

        if($sort_by == 'buyer_name'){
            $q->whereHas('buyer_list', function ($qr) use ($sort_type){
                $qr->orderBy('name', $sort_type);
            });
        }else if($sort_by == 'seller_name'){
            $q->whereHas('seller_list', function ($qr) use ($sort_type){
                $qr->orderBy('name', $sort_type);
            });
        }else{
            $q->orderBy($sort_by, $sort_type);
        }

        return $q->with(['buyer_list','seller_list'])->paginate($per_page);
        // return $q->orderBy($sort_by, $sort_type)->with(['buyer_list','seller_list'])->paginate($per_page);
    }

    public function getDataCount(Request $request){
        $q = DataCounts::query();
        $sort_by = $request->sort_by;
        $sort_type = $request->sort_type;
        $per_page = $request->per_page == null ? 10 : $request->per_page;

        if(!is_null($request->search_buyer_name)){
            $q->whereHas('buyer_list', function ($q) use ($request){
                $q->where('name', 'like', "%{$request->search_buyer_name}%");
            });
        }

        if(!is_null($request->search_seller_name)){
            $q->whereHas('seller_list', function ($q) use ($request){
                $q->where('name', 'like', "%{$request->search_seller_name}%");
            });
        }

        // if(!is_null($request->search_partner_code)){
        //     $q->whereHas('connect_table', function ($q) use ($request){
        //         $q->where('partner_code', 'like', "%{$request->search_partner_code}%");
        //     });
        // }

        if(!is_null($request->search_data_count)){
            $q->where('count', 'like', "%{$request->search_data_count}%");
        }


    
        if($sort_by == 'buyer_name'){
            $q->whereHas('buyer_list', function ($qr) use ($sort_type){
                $qr->orderBy('name', $sort_type);
            });
        }else if($sort_by == 'seller_name'){
            $q->whereHas('seller_list', function ($qr) use ($sort_type){
                $qr->orderBy('name', $sort_type);
            });
        }else if($sort_by == 'super_code'){
            $q->whereHas('buyer_list', function ($qr) use ($sort_by ,$sort_type){
                $qr->orderBy($sort_by, $sort_type);
            });
        }else if($sort_by == 'j_code'){
            $q->whereHas('seller_list', function ($qr) use ($sort_by ,$sort_type){
                $qr->orderBy($sort_by, $sort_type);
            });
        }
        // else if($sort_by == 'partner_code'){
        //     $q->whereHas(', function ($qr) use ($sort_by ,$sort_type){
        //         $qr->orderBy($sort_by, $sort_type);
        //     });
        // }
        else{
            $q->orderBy($sort_by, $sort_type);
        }

        return $q->with(['buyer_list','seller_list'])->paginate($per_page);
        // return $q->orderBy($sort_by, $sort_type)->with(['connect_table','connect_table.buyer_list','connect_table.seller_list'])->paginate($per_page);
    }

    public function dataCountStore(Request $request){
        $this->validate($request, [
            'buyer_id' => 'required',
            'count' => 'required|max:16',
            'seller_id' => 'required',
            'service_end' => 'required|date',
            'service_start' => 'required|date',
        ],[
            'buyer_id.required' => 'The buyer field is required.',
            'seller_id.required' => 'The seller field is required.'
        ]);

        // return $request;

       DataCounts::create([
            // 'connect_id' => $request->seller_id['seller_id'],
            'seller_id' => $request->seller_id['seller_id'],
            'buyer_id' => $request->buyer_id['buyer_id'],
            'start_date' => $request->service_start,
            'end_date' => $request->service_end,
            'count' => $request->count
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Connect successfully created.'
        ]);
    }


}
