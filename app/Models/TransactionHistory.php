<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'transaction_history';

    protected $fillable = [
        'member_account_id',
        'amount',
        'member_id',
        'staff_id',
        'description',
        'type',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    const DIRECTION_DEPOSIT = 'deposit';
    const DIRECTION_WITHDRAWAL = 'withdrawal';
    const DIRECTION_LOAN = 'loan';

    const DESCRIPTION_SIMPANAN_POKOK = 'simpanan pokok';
    const DESCRIPTION_SIMPANAN_WAJIB = 'simpanan wajib';
    const DESCRIPTION_SIMPANAN_SUKARELA = 'simpanan sukarela';
    const DESCRIPTION_SIBUHAR = 'sibuhar';
    const DESCRIPTION_LOAN = 'loan';

    public function memberAccount()
    {
        return $this->belongsTo(MemberAccount::class, 'member_account_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'supabase_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'supabase_id');
    }
}