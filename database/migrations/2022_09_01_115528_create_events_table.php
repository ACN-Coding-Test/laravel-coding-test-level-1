<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamp('createdAt')->nullable(false)->useCurrent();
            $table->timestamp('updatedAt')->nullable(false)->useCurrent();
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
