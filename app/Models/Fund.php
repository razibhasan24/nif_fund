<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory; 

    protected $fillable = ['member_id', 'amount', 'month'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
