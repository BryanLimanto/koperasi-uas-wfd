<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('members_history', function (Blueprint $table) {
            $table->id();
            $table->string('member_id');
            $table->text('description');
            $table->timestamp('updated_at');

            $table->foreign('member_id')
                  ->references('supabase_id')
                  ->on('members')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('members_history');
    }
};