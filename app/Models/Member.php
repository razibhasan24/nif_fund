<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['user_id', 'phone', 'address', 'join_date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function funds() {
        return $this->hasMany(Fund::class);
    }

    public function loanRequests() {
        return $this->hasMany(LoanRequest::class);
    }

    public function loans() {
        return $this->hasMany(Loan::class);
    }
}
