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
    // $this->middleware(['auth:sanctum']);
    $this->courseService = $courseService;
  }

  /**
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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      $course = $this->courseService->addNew($request);
      return $this->successResponse($course);
    } catch (\Exception $exception) {
      $message = $exception->getMessage();
      return $this->errorResponse($message);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
  }

  /**
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
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
