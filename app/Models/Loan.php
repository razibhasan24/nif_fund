<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['member_id', 'amount', 'installments', 'paid_amount', 'status'];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function installments() {
        return $this->hasMany(Installment::class);
    }
}

