<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'members';
    protected $primaryKey = 'supabase_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'supabase_id',
        'name',
        'email',
        'phone',
        'profile',
        'username',
        'email_verified_at',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
    ];

    public function history()
    {
        return $this->hasMany(MemberHistory::class, 'member_id', 'supabase_id');
    }

    public function accounts()
    {
        return $this->hasMany(MemberAccount::class, 'member_id', 'supabase_id');
    }

    public function transactions()
    {
        return $this->hasMany(TransactionHistory::class, 'member_id', 'supabase_id');
    }
}