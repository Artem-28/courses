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
}
