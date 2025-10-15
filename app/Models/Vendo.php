<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vendo extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'area_id',
        'address',
        'lhd',
        'shares',
        'key',
        'remarks',
        'status'
    ];

    protected $casts = [
        'lhd' => 'date',
    ];


    public function getDueDateAttribute()
    {
        return $this->lhd ? Carbon::parse($this->lhd)->addDays(31) : null;
    }

    // Accessor for status
    public function getStatusAttribute()
    {
        if (!$this->due_date) {
            return 'UNKNOWN';
        }

        $today = Carbon::today();

        return $today->gt($this->due_date) ? 'HARVEST TIME' : 'ON TIME';
    }

     // Accessor for days left
    public function getDaysLeftAttribute()
{
    if (!$this->due_date) {
        return null;
    }

    $today = Carbon::today();
    return $today->lt($this->due_date)
        ? $today->diffInDays($this->due_date)  // days remaining
        : -$this->due_date->diffInDays($today); // overdue
}


    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
