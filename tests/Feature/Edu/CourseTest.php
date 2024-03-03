<?php

namespace Tests\Feature\Edu;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Tests\Feature\BaseTestCase;

class CourseTest extends BaseTestCase
{

    public function test_course_relations(): void
    {
        $course = Course::find(1);
        $this->assertNotNull($course);

        $this->assertEquals($course->product->id, 1);
        $this->assertEquals($course->teacher->id, 19);

        $courseStudents = $course->students;
        $this->assertCount(7, $courseStudents);

        $this->assertCount(2, $course->journalRecords);
    }

    public function test_lesson_relations(): void
    {
        $lesson = Lesson::find(1);
        $this->assertNotNull($lesson);

        $this->assertEquals($lesson->course->id, 1);
        $this->assertEquals($lesson->teacher->id, 19);

        $lessonStudents = $lesson->students;
        $this->assertCount(3, $lessonStudents);

        $this->assertCount(7, $lesson->course->students);

        $this->assertCount(3, $lesson->journalRecords);

    }

    public function test_student_relations(): void
    {
        $user = User::find(11);
        $this->assertNotNull($user);
        $lessons = $user->lessons;
        $this->assertCount(3, $lessons);

        $user = User::find(20);
        $this->assertNotNull($user);
        $courses = $user->courses;
        $this->assertCount(2, $courses);






    }



/*
    public function test_course_schedule(): void
    {
        $service = CourseService::make();

        $course = Course::find(1);
        $date = Carbon::today()->isoWeekday(2)->hours(18)->minute(0);
        $this->assertTrue($service->checkCourseIsActual($course, $date));

        $course = Course::find(2);
        $date = Carbon::today()->isoWeekday(3)->hours(18)->minute(0);
        $this->assertTrue($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(6)->hours(11)->minute(15);
        $this->assertTrue($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(3)->hours(16)->minute(0);
        $this->assertFalse($service->checkCourseIsActual($course, $date));

    }



*/
}
