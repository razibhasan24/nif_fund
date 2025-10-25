<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $fillable = ['member_id', 'amount', 'month'];

    public function member() {
        return $this->belongsTo(Member::class);
    }
}

