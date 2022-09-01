<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'order'
  ];

  public function lessons()
  {
      return $this->belongsToMany(Lesson::class);
  }
}
