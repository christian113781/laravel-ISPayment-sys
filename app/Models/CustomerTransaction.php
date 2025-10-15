<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'amount',
        'payment_method',
        'remarks',
        'receipt_number',
        'receipt_image',
    ];

    // Relation to Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
