<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAndAddDataCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_counts', function($table) {
            $table->dropColumn(['connect_id']);

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
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_counts', function($table) {
            $table->integer('connect_id');
         });
    }
}
