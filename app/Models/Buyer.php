<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'buyer_id';
    protected $dates = ['deleted_at'];
    protected $fillable = ['super_code','name','name_kana','post_code','address','tel','fax','billing_post_code','billing_address','billing_tel','billing_fax'];

    public function connect_table(){
        return $this->hasMany(Connect::class, 'buyer_id');
    }
    

    
}
