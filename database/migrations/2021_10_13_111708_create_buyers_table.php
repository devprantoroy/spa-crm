<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->increments('buyer_id');
            $table->char('super_code',5)->comment('スーパーコード')->unique();
            $table->string('name',100)->comment('小売名');
            $table->string('name_kana',100)->comment('小売名かな');
            $table->string('post_code',8)->comment('郵便番号');
            $table->string('address',500)->comment('住所');
            $table->string('tel',15)->comment('電話番号');
            $table->string('fax',15)->comment('FAX番号');
            $table->string('billing_post_code',8)->comment('請求郵便番号');
            $table->string('billing_address',500)->comment('請求住所');
            $table->string('billing_tel',15)->comment('請求電話番号');
            $table->string('billing_fax',15)->comment('請求FAX番号');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyers');
    }
}
