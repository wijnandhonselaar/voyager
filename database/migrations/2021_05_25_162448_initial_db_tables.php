<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialDbTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('name');
            $table->string("imo");
        });

        Schema::create('voyages', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('vessel_id');
            $table->string("code");
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string("imo");
            $table->string("status")->default("pending");
            $table->decimal("revenues", 8, 2);
            $table->decimal("expenses", 8, 2);
            $table->decimal("profit", 8, 2);

            $table->foreign('vessel_id')
                ->references('id')
                ->on('vessels');
        });

        Schema::create('vessel_opex', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('vessel_id');
            $table->timestamp("date")->unique();
            $table->decimal("expenses", 8, 2);

            $table->foreign('vessel_id')
                ->references('id')
                ->on('vessels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessel_opex');
        Schema::dropIfExists('voyages');
        Schema::dropIfExists('vessels');
    }
}
