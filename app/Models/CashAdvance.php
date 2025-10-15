<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{
    protected $fillable = ['employee_id', 'amount', 'date', 'remarks'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
