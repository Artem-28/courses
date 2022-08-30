<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public function getList()
    {
        return Course::all();
    }

    public function getById($id)
    {
        return Course::where('id', $id)->first();
    }

    //сщздать новый курс
    public function addNew($data)
    {
      $lesson = Course::create([
        'title' => $data['title'],
        'description' => $data['description'],
        'order' => $data['order']
      ]);
      
      return $lesson;
    }

    public function updateById($id, $data)
    {
        return Course::where('id', $id)->first()->update([
          'title' => $data->title,
          'description' => $data->description,
          'order' => $data->order
        ]);
    }
}
