<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',     // Added gender
        'image',      // Added image
        'bio',        // Added bio
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Hashing is only supported in Laravel 10+
    ];

    /**
     * Handle image upload and save the path.
     *
     * @param  \Illuminate\Http\UploadedFile  $image
     * @return string
     */
    public function uploadImage($image)
    {
        // Define the path where images will be stored
        $imagePath = $image->store('profile_images', 'public');
        
        // Save image path to the database
        $this->image = $imagePath;
        $this->save();

        return $imagePath;
    }
}
