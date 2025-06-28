<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staffs';
    protected $primaryKey = 'supabase_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'supabase_id',
        'name',
        'email',
        'phone',
        'username',
        'profile',
        'email_verified_at',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
    ];

    public function history()
    {
        return $this->hasMany(StaffHistory::class, 'staff_id', 'supabase_id');
    }
}