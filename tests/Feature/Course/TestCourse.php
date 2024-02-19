<?php

namespace Tests\Feature\Course;

use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class TestCourse extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
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
    public function test_course_checkin(): void
    {
        $response = $this->get('/api/checkin/AJV0');

        $response->assertStatus(200);
        $response->assertContent("error");
    }
}
