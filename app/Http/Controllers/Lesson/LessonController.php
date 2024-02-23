<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Controllers\BaseController;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new LessonResource(Lesson::get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'course_id' => 'numeric|required',
            'title' => 'string|nullable'
        ];
        $validated = $request->validate($rules);
        $lesson = new Lesson();
        $lesson ->course_id = $validated['course_id'];
        $lesson ->title = data_get($validated, 'title');
        $lesson->save();
        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'lesson_id' => 'numeric|required',
            'course_id' => 'numeric|required',
            'title' => 'string|nullable'
        ];

        $validated = $request->validate($rules);
        $lesson_id = $validated['lesson_id'];
        $lesson = Lesson::find($lesson_id);
        $lesson->course_id = $validated['course_id'];
        $lesson->title = data_get($validated, 'title');
        $lesson->save();
        return new LessonResource($lesson);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
