<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanRequest extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'amount', 'reason', 'status'];

    public function member() { return $this->belongsTo(Member::class); }
}
