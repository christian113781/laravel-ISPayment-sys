<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'plan_id',
        'area_id',
        'address',
        'lpd',
        'remarks',
        'status'
    ];

    protected $casts = [
        'lpd' => 'date',
    ];


    public function getDueDateAttribute()
    {
        return $this->lpd ? Carbon::parse($this->lpd)->addDays(32) : null;
    }

    // Accessor for status
    public function getStatusAttribute()
    {
        if (!$this->due_date) {
            return 'UNKNOWN';
        }

        $today = Carbon::today();

        return $today->gt($this->due_date) ? 'DUE' : 'ON TIME';
    }

     // Accessor for days left
    public function getDaysLeftAttribute()
    {
        if (!$this->due_date) {
            return null;
        }

        $today = Carbon::today();
        return $today->diffInDays($this->due_date, false); 
        // positive = days remaining, negative = overdue days
    }



    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
