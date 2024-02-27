<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Lesson\LessonResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    public function index(){
        $courses = CourseResource::collection(Course::with('teacher')->orderBy('id')->get());
        return $this->inertiaFromResource('Teacher/Home', $courses);
    }

    public function show(int $courseId){
        $courseResource = new CourseResource(Course::findOrFail($courseId));

        return $this->inertiaFromResource('Teacher/Course', $courseResource);

        $lessonResource = new LessonResource(Lesson::with('course',  'teacher')->where('course_id', $courseId)->orderBy('id')->get());
        return $this->inertia('Teacher/Course', [
            'lessons' => $lessonResource->toArray(request()),
            'course' => $courseResource->toArray(request())
        ]);
    }

    public function update(Request $request, string $courseId)
    {
        $rules = [
            'title' => 'string|nullable'
        ];

        $request->validate($rules);
        $lesson = Course::find($courseId);
        //dd($lesson);
        $lesson->title = $request->get('title');
        $lesson->comment = $request->get('comment');

        $lesson->save();
        return new CourseResource($lesson);
    }
}
