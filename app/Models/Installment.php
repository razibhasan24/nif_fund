<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id', 'amount', 'payment_date'];

    public function loan() { return $this->belongsTo(Loan::class); }
}
