<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    protected $fillable = ['member_id', 'amount', 'reason', 'status'];

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
