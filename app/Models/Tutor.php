<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Table Name
    protected $table = 'tutors_registration';

    // Primary Key
    protected $primaryKey = 'tutor_id';

    // Auto-incrementing
    public $incrementing = true;

    // Primary Key Type
    protected $keyType = 'int';

    // Timestamps
    public $timestamps = true;

    // Fillable Fields
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'gender', 
        'phone_number', 
        'image', 
        'department', 
        'bio', 
        'achievements',
    ];

    // Hidden Fields (e.g., for serialization)
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // Casts for Attributes
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship: A tutor has many modules
    public function modules()
    {
        return $this->hasMany(Module::class, 'tutor_id');
    }
}
