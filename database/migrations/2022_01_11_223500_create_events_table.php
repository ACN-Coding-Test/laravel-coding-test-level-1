<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $uuid = DB::raw('UUID()');
            $table->uuid('id')->default($uuid)->primary();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
			$table->softDeletes();
            $table->timestamp('createdAt', $precision = 0)->useCurrent();
            $table->timestamp('updatedAt', $precision = 0)->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
