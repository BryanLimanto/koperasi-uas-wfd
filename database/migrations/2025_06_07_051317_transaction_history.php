<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_account_id');
            $table->decimal('amount', 15, 2);
            $table->string('member_id')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('description'); // simpanan pokok, wajib, sukarela, sibuhar, loan
            $table->string('type');
            $table->timestamps();

            $table->foreign('member_account_id')
                  ->references('id')
                  ->on('member_accounts')
                  ->onDelete('cascade');

            $table->foreign('member_id')
                  ->references('supabase_id')
                  ->on('members')
                  ->onDelete('cascade');

            $table->foreign('staff_id')
                  ->references('supabase_id')
                  ->on('staffs')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_history');
    }
};