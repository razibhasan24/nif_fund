<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'amount', 'installments', 'paid_amount', 'status'];

    public function member() { return $this->belongsTo(Member::class); }
    public function installments() { return $this->hasMany(Installment::class); }
}
