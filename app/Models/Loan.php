<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [

    	'user_id',
        'book_id',
        
    	'loan_date',
        'return_date',
        'status',
        
        
    ];
}
