<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'phone', 'address', 'join_date'];

    public function user() { return $this->belongsTo(User::class); }
    public function funds() { return $this->hasMany(Fund::class); }
    public function loanRequests() { return $this->hasMany(LoanRequest::class); }
    public function loans() { return $this->hasMany(Loan::class); }
}
