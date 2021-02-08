<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends BaseModel
{
    use HasFactory;

    protected $table        = 'transactions';
    protected $fillable     = ['patient_id', 'transactions_type', 'amount', 'notes', 'enabled'];
}
