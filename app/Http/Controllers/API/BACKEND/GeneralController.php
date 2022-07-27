<?php

namespace App\Http\Controllers\API\BACKEND;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Connect;
use App\Models\DataCounts;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    public function importConnect(Request $request){
        $this->validate($request, [
            'file_url' => 'required'
        ]);
        try{
            set_time_limit(0);
            $data = $this->base64_to_file($request->file_url,public_path('/file/import_buyer.csv'));
            $customerArr = $this->csvToArray($data);
    
            for ($i = 0; $i < count($customerArr); $i ++){
                $this->is_valid($customerArr[$i]['j_code'],8);
                $this->is_valid($customerArr[$i]['super_code'],5);
                $this->is_valid($customerArr[$i]['service_end']);
                $this->is_valid($customerArr[$i]['service_start']);
    
                $seller = Seller::where('j_code',$customerArr[$i]['j_code'])->first();
                $buyer = Buyer::where('super_code',$customerArr[$i]['super_code'])->first();
    
                if($seller instanceof Seller && $buyer instanceof Buyer){
                    Connect::create([
                        'seller_id' => $seller->seller_id,
                        'buyer_id' => $buyer->buyer_id,
                        'partner_code' => $customerArr[$i]['partner_code'],
                        'service_start' => $customerArr[$i]['service_start'],
                        'service_end' => $customerArr[$i]['service_end'],
                    ]);
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Buyers & Sellers Connection Insert completed successfully.'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => "CSV file is not well formatted."
            ]);
        }
      

    }

    public function buyerSellerImport(Request $request){

        $this->validate($request, [
            'type' => 'required',
            'file_url' => 'required'
        ]);

        try{
            set_time_limit(0);
            if($request->type == 1){
                $data = $this->base64_to_file($request->file_url,public_path('/file/import_buyer.csv'));
                $customerArr = $this->csvToArray($data);
                
                for ($i = 0; $i < count($customerArr); $i ++){
        
                    $this->is_valid($customerArr[$i]['name'],100);
                    $this->is_valid($customerArr[$i]['name_kana'],100);
                    $this->is_valid($customerArr[$i]['post_code'],8);
                    $this->is_valid($customerArr[$i]['address'],500);
                    $this->is_valid($customerArr[$i]['fax'],15);
                    $this->is_valid($customerArr[$i]['tel'],15);
                    $this->is_valid($customerArr[$i]['billing_post_code'],15);
                    $this->is_valid($customerArr[$i]['billing_address'],500);
                    $this->is_valid($customerArr[$i]['billing_tel'],15);
                    $this->is_valid($customerArr[$i]['billing_fax'],15);
                    $this->is_valid($customerArr[$i]['name'],100);
                    $exist = Buyer::where('super_code',trim($customerArr[$i]['super_code']))->first();
                    if($exist instanceof Buyer){
                        return response()->json([
                            'success' => false,
                            'message' => $customerArr[$i]['super_code'].' already exist'
                        ]);
                    }
                    Buyer::create($customerArr[$i]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Buyers Insert completed successfully.'
                ]);
            }elseif($request->type == 2){
                $data = $this->base64_to_file($request->file_url,public_path('/file/import_seller.csv'));
                $customerArr = $this->csvToArray($data);
                
                for ($i = 0; $i < count($customerArr); $i ++){
        
                    $this->is_valid($customerArr[$i]['name'],100);
                    $this->is_valid($customerArr[$i]['name_kana'],100);
                    $this->is_valid($customerArr[$i]['post_code'],8);
                    $this->is_valid($customerArr[$i]['address'],500);
                    $this->is_valid($customerArr[$i]['fax'],15);
                    $this->is_valid($customerArr[$i]['tel'],15);
                    $this->is_valid($customerArr[$i]['billing_post_code'],15);
                    $this->is_valid($customerArr[$i]['billing_address'],500);
                    $this->is_valid($customerArr[$i]['billing_tel'],15);
                    $this->is_valid($customerArr[$i]['billing_fax'],15);
                    $this->is_valid($customerArr[$i]['name'],100);
                    $exist = Seller::where('j_code',trim($customerArr[$i]['j_code']))->first();
                    if($exist instanceof Seller){
                        return response()->json([
                            'success' => false,
                            'message' => $customerArr[$i]['j_code'].' already exist'
                        ]);
                    }
                    Seller::create($customerArr[$i]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Sellers Insert completed successfully.'
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => "Invalid"
                ]);
            }  
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => "CSV file is not well formatted."
            ]);
        } 
    }

    public function countImport(Request $request){
        $this->validate($request, [
            'file_url' => 'required'
        ]);
        try {
            set_time_limit(0);
            $data = $this->base64_to_file($request->file_url,public_path('/file/import_buyer.csv'));
            $customerArr = $this->csvToArray($data);

            for ($i = 0; $i < count($customerArr); $i ++){
                $this->is_valid($customerArr[$i]['j_code'],8);
                $this->is_valid($customerArr[$i]['super_code'],5);
                $this->is_valid($customerArr[$i]['end_date']);
                $this->is_valid($customerArr[$i]['start_date']);
                $this->is_valid($customerArr[$i]['count']);
    
                $seller = Seller::where('j_code',$customerArr[$i]['j_code'])->first();
                $buyer = Buyer::where('super_code',$customerArr[$i]['super_code'])->first();
    
                if($seller instanceof Seller && $buyer instanceof Buyer){
                    DataCounts::create([
                        'seller_id' => $seller->seller_id,
                        'buyer_id' => $buyer->buyer_id,
                        'start_date' => $customerArr[$i]['start_date'],
                        'end_date' => $customerArr[$i]['end_date'],
                        'count' => $customerArr[$i]['count'],
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Data-Count Insert completed successfully.'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => "CSV file is not well formatted."
            ]);
        }
        
    }

    

    function csvToArray($filename = '', $delimiter = ','){
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    function is_valid($item, $customField = NULL){
        $item = trim($item);
        if(isset($item) && strlen($item) <= $customField){
            return true;
        }
        return response()->json([
            'success' => false,
            'message' => 'Invalid Date Type.'
        ]);
        
    }

    function base64_to_file($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 
    
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );
    
        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    
        // clean up the file resource
        fclose( $ifp ); 
    
        return $output_file; 
    }
}
