<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('staffs_history', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->text('description');
            $table->timestamp('updated_at');

            $table->foreign('staff_id')
                  ->references('supabase_id')
                  ->on('staffs')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('staffs_history');
    }
};