<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Traits\Csv;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    use Csv;
    
    public function index(Request $request)
    {
        $sort_by = $request->sort_by;
        $sort_type = $request->sort_type;
        $per_page = $request->per_page == null ? 10 : $request->per_page;

        $q = Buyer::query();
        if(!is_null($request->search_super_code)){
            $q->where('super_code', 'like', "%{$request->search_super_code}%");
        }

        if(!is_null($request->search_name)){
            $q->where('name', 'like', "%{$request->search_name}%");
        }
        
        $Buyers = $q->orderBy($sort_by, $sort_type)->paginate($per_page);

        // return auth()->user();
        return $Buyers;      
    }

    public function getBuyer()
    {
        $Buyers = Buyer::latest()->with(['connect_table','connect_table.seller_list'])->get();
        return $Buyers;      
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'super_code' => 'required|max:5|unique:buyers',
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

        $buyer = new Buyer([
            'super_code' => $request->super_code,
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
        $buyer->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Buyer created successfully.'
        ]);
    }

    public function show($id)
    {
        $buyer = Buyer::find($id);
        return response()->json($buyer);
    }

    public function update($id, Request $request)
    {
        $buyer = Buyer::find($id);
        
        $this->validate($request, [
            'super_code' => 'required|max:5|unique:buyers,super_code,'.$buyer->buyer_id.',buyer_id',
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
        
        
        $buyer->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Buyer Updated successfully.',
            'data' => $buyer
        ]);
    }

    public function destroy($id)
    {
        $buyer = Buyer::where('buyer_id',$id)->first();
        $buyer->delete();
        return response()->json([
            'success' => true,
            'message' => 'Buyer Deleted successfully.'
        ]);
    }   

    public function buyerCsv(Request $request){

        $q = Buyer::query();

        if(!is_null($request->search_super_code)){
            $q->where('super_code', 'like', "%{$request->search_super_code}%");
        }

        if(!is_null($request->search_name)){
            $q->where('name', 'like', "%{$request->search_name}%");
        }

        $fileName = 'export_buyer.csv';
        $tasks = $q->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        
        $columns = array('Super Code','Name','Name Kana','Post Code','Address','Telephone','Fax','Billing Post Code','Billing Address','Billing Telephone','Billing Fax','Created At');
        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Super Code']  = $task->super_code;
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

                fputcsv($file, array($row['Super Code'],$row['Name'],$row['Name Kana'],$row['Post Code'],$row['Address'],$row['Telephone'],$row['Fax'],$row['Billing Post Code'],$row['Billing Address'],$row['Billing Telephone'],$row['Billing Fax'],$row['Created At']));
            }

            fclose($file);
        };    
        return response()->stream($callback, 200, $headers);
    }

}
