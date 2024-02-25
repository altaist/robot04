<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Lesson\LessonCollection;
use App\Http\Resources\Lesson\LessonCollectionResource;
use App\Http\Resources\Lesson\LessonFullResource;
use App\Http\Resources\Lesson\LessonIdResource;
use App\Http\Resources\Lesson\LessonResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $courseId){
        $courseResource = new CourseResource(Course::findOrFail($courseId));
        $lessonResource = new LessonResource(Lesson::with('course',  'teacher')->where('course_id', $courseId)->orderBy('id')->get());

        return $this->inertia('Teacher/Course', [
            'lessons' => $lessonResource->toArray(request()),
            'course' => $courseResource->toArray(request())
        ]);
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
            'teacher_id' => 'numeric|required',
            'title' => 'string|nullable'
        ];
        $validated = $request->validate($rules);
        $lesson = new Lesson();
        $lesson ->course_id = $validated['course_id'];
        $lesson ->teacher_id = $validated['teacher_id'];
        $lesson ->title = data_get($validated, 'title');
        $lesson->save();
        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $lessonResource = new LessonFullResource($lesson);
        return $this->inertiaFromResource('Teacher/Lesson', $lessonResource);
    }

    public function toggle($lessonId, $userId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $user = Lesson::findOrFail($userId);

        $lesson->students->toggle($userId);
        // updateExistingPivot($userId, ['active'=>1])
        return $userId;
    }

    public function syncStudents(Request $request, $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $students = $request->get('students');

        $lesson->students()->sync($students);
        // updateExistingPivot($userId, ['active'=>1])
        return $lesson->students->pluck("id");
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
    public function update(Request $request, string $lessonId)
    {
        $rules = [
            'title' => 'string|nullable'
        ];

        $request->validate($rules);
        $lesson = Lesson::find($lessonId);
        $lesson->title = $request->get('title');
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
