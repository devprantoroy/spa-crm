<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'seller_id';
    protected $dates = ['deleted_at'];
    protected $fillable = ['j_code','name','name_kana','post_code','address','tel','fax','billing_post_code','billing_address','billing_tel','billing_fax'];
}
