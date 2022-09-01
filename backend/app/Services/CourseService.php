<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Lesson;

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
  public function addNew($data, $account_id)
  {
    $course = new Course;

    $course->title = $data->title;
    $course->description = $data->description;
    $course->order = $data->order;
    $course->account_id = $account_id;

    $course->save();
    return $course;
  }

  public function updateById($id, $data)
  {
    return Course::where('id', $id)->first()->update([
      'title' => $data->title,
      'description' => $data->description,
      'order' => $data->order
    ]);
  }

  public function addLessons($data)
  {
    $course = Course::where('id', $data->course_id)->first();
    foreach ($data->lesson_ids as $lesson_id) {
      $lesson = Lesson::where('id', $lesson_id)->first();
      if ($lesson && !$course->lessons->contains($lesson_id)) $course->lessons()->attach($lesson, ['order' => 25]);
    }

    return $course;
  }
}
