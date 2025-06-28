<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberHistory extends Model
{
    use HasFactory;

    protected $table = 'members_history';

    public $timestamps = false;

    protected $fillable = [
        'member_id',
        'description',
        'updated_at',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'supabase_id');
    }
}