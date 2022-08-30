<?php

namespace App\Services;

use App\Models\Lesson;

class LessonService
{
  public function getList()
  {
    return Lesson::all();
  }

  public function getById($id)
  {
    return Lesson::where('id', $id)->first();
  }

  public function addNew($data)
  {
    $lesson = Lesson::create([
      'title' => $data['title'],
      'description' => $data['description'],
      'order' => $data['order']
    ]);
    
    return $lesson;
  }



  public function updateById($id, $data)
  {
    return Lesson::where('id', $id)->first()->update([
      'title' => $data->title,
      'description' => $data->description,
      'order' => $data->order
    ]);
  }
}
