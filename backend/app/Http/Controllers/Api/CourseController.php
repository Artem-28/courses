<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\CourseService;

class CourseController extends Controller
{
  public CourseService $courseService;

  public function __construct(
    CourseService $courseService,
  ) {
    $this->middleware(['auth:sanctum']);
    $this->courseService = $courseService;
  }

  /**
   * Get all courses
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $courses = $this->courseService->getList();
    return $this->successResponse($courses);
  }


  /**
   * Add new course
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      $account = auth()->user()->account;
      $course = $this->courseService->addNew($request, $account->id);

      return $this->successResponse($course);
    } catch (\Exception $exception) {
      $message = $exception->getMessage();
      return $this->errorResponse($message);
    }
  }


  /**
   * Ger course by id
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $course = $this->courseService->getById($id);
    return $this->successResponse($course);
  }

  /**
   * Edit course by id
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    try {
      $course = $this->courseService->updateById($id, $request);

      return $this->successResponse($course);
    } catch (\Exception $exception) {
      $message = $exception->getMessage();
      return $this->errorResponse($message);
    }
  }

  /**
   * Add lessons to course.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function addLessons(Request $request)
  {
    try {
      $course = $this->courseService->addLessons($request);

      return $this->successResponse($course);
    } catch (\Exception $exception) {
      $message = $exception->getMessage();
      return $this->errorResponse($message);
    }
  }
}
