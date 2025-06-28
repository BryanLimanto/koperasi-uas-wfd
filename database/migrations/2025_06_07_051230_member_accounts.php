<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('member_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('member_id');
            $table->decimal('simpanan_pokok', 15, 2)->default(0);
            $table->decimal('simpanan_wajib', 15, 2)->default(0);
            $table->decimal('simpanan_sukarela', 15, 2)->default(0);
            $table->decimal('sibuhar', 15, 2)->default(0);
            $table->decimal('loan', 15, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

            $table->foreign('member_id')
                  ->references('supabase_id')
                  ->on('members')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('member_accounts');
    }
};