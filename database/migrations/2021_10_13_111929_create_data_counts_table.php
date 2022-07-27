<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_counts', function (Blueprint $table) {
            $table->increments('data_count_id');
            // $table->integer('connect_id')->unsigned();
            $table->integer('seller_id')->unsigned();
            $table->integer('buyer_id')->unsigned();
            $table->enum('type',['発注','支払','その他'])->default('発注')->comment('種別');
            $table->date('start_date')->comment('集計開始日');
            $table->date('end_date')->comment('集計終了日');
            $table->mediumInteger('count')->comment('データ数');

            $table->foreign('seller_id')
            ->references('seller_id')
            ->on('sellers')
            ->onDelete('cascade');

            $table->foreign('buyer_id')
            ->references('buyer_id')
            ->on('buyers')
            ->onDelete('cascade');

            // $table->foreign('connect_id')
            // ->references('connect_id')
            // ->on('connects')
            // ->onDelete('cascade');

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
        Schema::dropIfExists('data_counts');
    }
}
