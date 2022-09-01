<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\LessonService;

class LessonController extends Controller
{
  public LessonService $lessonService;

  public function __construct(
    LessonService $lessonService,
  ) {
    $this->middleware(['auth:sanctum']);
    $this->lessonService = $lessonService;
  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $lessons = $this->lessonService->getList();
    return $this->successResponse($lessons);
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
      $account = auth()->user()->account;
      $lesson = $this->lessonService->addNew($request, $account->id);
      return $this->successResponse($lesson);
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
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $lesson = $this->lessonService->getById($id);
    return $this->successResponse($lesson);
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
      $lesson = $this->lessonService->updateById($id, $request);

      return $this->successResponse($lesson);
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
