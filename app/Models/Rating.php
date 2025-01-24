<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
  use HasFactory;

  protected $fillable = ['tutor_id', 'student_id', 'rating', 'comment'];

  public function tutor()
{
    return $this->belongsTo(Tutor::class, 'tutor_id');
}

public function student()
{
    return $this->belongsTo(Student::class, 'student_id');
}


}
