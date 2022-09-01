<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'order'
  ];

  public function courses()
  {
      return $this->belongsToMany(Course::class);
  }
}
