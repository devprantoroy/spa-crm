<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataCounts extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'data_count_id';
    protected $dates = ['deleted_at'];
    protected $fillable = ['seller_id','buyer_id','type','start_date','end_date','count'];

    public function buyer_list(){
        return $this->hasOne(Buyer::class, 'buyer_id','buyer_id');
    }

    public function seller_list(){
        return $this->hasOne(Seller::class, 'seller_id','seller_id');
    }
}
