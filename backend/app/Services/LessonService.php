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

  public function addNew($data, $account_id)
  {
    $lesson = new Lesson;
      
    $lesson->title = $data->title;
    $lesson->description = $data->description;
    $lesson->order = $data->order;
    $lesson->account_id = $account_id;

    $lesson->save();
    
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
