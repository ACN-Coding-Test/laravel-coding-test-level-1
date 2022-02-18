<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
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
            $table->uuid('id')->default($uuid)->unique()->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->dateTime('startAt')->nullable();
            $table->dateTime('endAt')->nullable();
            $table->dateTime('createdAt')->useCurrent()->nullable($value = false);
            $table->dateTime('updatedAt')->useCurrent()->useCurrentOnUpdate()->nullable($value = false);
            $table->timestamps();
            $table->softDeletes();
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
};
