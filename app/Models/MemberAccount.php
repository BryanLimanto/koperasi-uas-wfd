<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAccount extends Model
{
    use HasFactory;

    protected $table = 'member_accounts';

    protected $fillable = [
        'member_id',
        'simpanan_pokok',
        'simpanan_wajib',
        'simpanan_sukarela',
        'sibuhar',
        'loan',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'supabase_id');
    }

    public function transactions()
    {
        return $this->hasMany(TransactionHistory::class, 'member_account_id');
    }
}