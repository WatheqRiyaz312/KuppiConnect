<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'name',
        'description',
        'date',
        'time',
        'resources'
    ];

    // Relationship with Tutor
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }

    public function getDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value)); // Format date to 'dd-mm-yyyy'
    }

    // Get formatted date and time together
    public function getFormattedDateTime()
    {
        return $this->date . ' ' . $this->time;
    }
}

