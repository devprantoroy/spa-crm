<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_by = $request->sort_by;
        $sort_type = $request->sort_type;
        $per_page = $request->per_page == null ? 10 : $request->per_page;

        $q = Seller::query();
        if(!is_null($request->search_j_code)){
            $q->where('j_code', 'like', "%{$request->search_j_code}%");
        }

        if(!is_null($request->search_name)){
            $q->where('name', 'like', "%{$request->search_name}%");
        }

        $seller = $q->orderBy($sort_by, $sort_type)->paginate($per_page);
        return $seller; 
    }

    public function getSeller()
    {
        $seller = Seller::latest()->get();
        return $seller; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'j_code' => 'required|max:5|unique:sellers',
            'name' => 'required|max:100',
            'name_kana' => 'required|max:100',
            'post_code' => 'required|max:8',
            'address' => 'required|max:500',
            'fax' => 'required|max:15',
            'tel' => 'required|max:15',
            'billing_post_code' => 'required|max:15',
            'billing_address' => 'required|max:500',
            'billing_tel' => 'required|max:15',
            'billing_fax' => 'required|max:15',
        ]);

        $seller = new Seller([
            'j_code' => $request->j_code,
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'fax' => $request->fax,
            'tel' => $request->tel,
            'billing_post_code' => $request->billing_post_code,
            'billing_address' => $request->billing_address,
            'billing_tel' => $request->billing_tel,
            'billing_fax' => $request->billing_fax,
        ]);
        $seller->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Seller created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Seller::find($id);
        return response()->json($seller);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);
        
        $this->validate($request, [
            'j_code' => 'required|max:5|unique:sellers,j_code,'.$seller->seller_id.',seller_id',
            'name' => 'required|max:100',
            'name_kana' => 'required|max:100',
            'post_code' => 'required|max:8',
            'address' => 'required|max:500',
            'fax' => 'required|max:15',
            'tel' => 'required|max:15',
            'billing_post_code' => 'required|max:15',
            'billing_address' => 'required|max:500',
            'billing_tel' => 'required|max:15',
            'billing_fax' => 'required|max:15',
        ]);
        
        
        $seller->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Seller Updated successfully.',
            'data' => $seller
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = Seller::where('seller_id',$id)->first();
        $seller->delete();
        return response()->json([
            'success' => true,
            'message' => 'Seller Deleted successfully.'
        ]);
    }

    public function restoreVal($id)
    {
        $seller = Seller::where('seller_id',$id)->first();
        $seller->delete();
        return response()->json([
            'success' => true,
            'message' => 'Seller Deleted successfully.'
        ]);
    }

    public function sellerCsv(Request $request){

        $q = Seller::query();

        if(!is_null($request->search_j_code)){
            $q->where('j_code', 'like', "%{$request->search_j_code}%");
        }

        if(!is_null($request->search_name)){
            $q->where('name', 'like', "%{$request->search_name}%");
        }

        $fileName = 'export_seller.csv';
        $tasks = $q->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        
        $columns = array('Jan Code','Name','Name Kana','Post Code','Address','Telephone','Fax','Billing Post Code','Billing Address','Billing Telephone','Billing Fax','Created At');
        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Jan Code']  = $task->j_code;
                $row['Name']    = $task->name;
                $row['Name Kana']    = $task->name_kana;
                $row['Post Code']    = $task->post_code;
                $row['Address']    = $task->address;
                $row['Telephone']    = $task->tel;
                $row['Fax']    = $task->fax;
                $row['Billing Post Code']    = $task->billing_post_code;
                $row['Billing Address']    = $task->billing_address;
                $row['Billing Telephone']    = $task->billing_tel;
                $row['Billing Fax']    = $task->billing_fax;
                $row['Created At']    = date('Y-m-d',strtotime($task->created_at));

                fputcsv($file, array($row['Jan Code'],$row['Name'],$row['Name Kana'],$row['Post Code'],$row['Address'],$row['Telephone'],$row['Fax'],$row['Billing Post Code'],$row['Billing Address'],$row['Billing Telephone'],$row['Billing Fax'],$row['Created At']));
            }

            fclose($file);
        };    
        return response()->stream($callback, 200, $headers);
    }
}
