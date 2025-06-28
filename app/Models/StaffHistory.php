<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffHistory extends Model
{
    use HasFactory;

    protected $table = 'staffs_history';

    public $timestamps = false;

    protected $fillable = [
        'staff_id',
        'description',
        'updated_at',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'supabase_id');
    }
}