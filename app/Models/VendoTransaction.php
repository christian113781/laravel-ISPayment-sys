<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendoTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendo_id',
        'amount',
        'remarks',
        'receipt_image',
    ];

    // Relation to Customer
    public function vendo()
    {
        return $this->belongsTo(Vendo::class);
    }

    // Accessor for S.Amount
    public function getSAmountAttribute()
    {
        return $this->amount * ($this->vendo->shares / 100);
    }

    // Accessor for My Share
    public function getMyShareAttribute()
    {
        return $this->amount - $this->s_amount;
    }
}
