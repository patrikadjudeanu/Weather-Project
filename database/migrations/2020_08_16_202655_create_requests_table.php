<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 3, 1);
            $table->decimal('longitude', 4, 1);
            $table->decimal('temperature', 3, 1);
            $table->timestamps();
            $table->dropColumn('updated_at'); 
            $table->string('location');
            $table->integer('requestable_id')->unsigned();
            $table->string('requestable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
