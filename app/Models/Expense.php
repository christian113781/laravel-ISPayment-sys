<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expenses_date',   
        'type',          
        'amount',        
        'description',     
        'receipt_image', 
    ];
}
