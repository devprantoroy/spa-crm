<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connects', function (Blueprint $table) {
            $table->increments('connect_id');
            $table->integer('seller_id')->unsigned();
            $table->integer('buyer_id')->unsigned();

            $table->foreign('seller_id')
            ->references('seller_id')
            ->on('sellers')
            ->onDelete('cascade');

            $table->foreign('buyer_id')
            ->references('buyer_id')
            ->on('buyers')
            ->onDelete('cascade');


            $table->string('partner_code',10)->comment('取引先コード');
            $table->date('service_start')->comment('開始日');
            $table->date('service_end')->comment('終了日');
            
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
        Schema::dropIfExists('connects');
    }
}
