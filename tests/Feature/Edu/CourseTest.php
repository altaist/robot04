<?php

namespace Tests\Feature\Edu;

use App\Models\Course;
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
