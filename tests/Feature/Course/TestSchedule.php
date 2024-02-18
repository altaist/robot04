<?php

namespace Tests\Feature\Course;

use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class TestSchedule extends TestCase
{
    public function test_schedule_is_actual(): void
    {
        $schedule1 = [
            'monthes' => [9, 10, 11, 12, 1, 2, 3, 4, 5],
            'weeks' => [],
            'days' => [
                [], ['12:00', '14:00'], [], [], [], ['10:00', '11:00'], []
            ]
        ];

        $schedule2 = [
            'days2' => []
        ];

        $schedule3 = [
            'monthes' => [9, 10, 11, 12, 1, 2, 3, 4, 5],
            'weeks' => [],
            'days' => [
                [], ['12sd:00', '14:00'], []
            ]
        ];

        $service = CourseService::make();

        $course = new Course();
        $course->schedule = $schedule1;

        //dd($course->schedule);

        $date = Carbon::today()->isoWeekday(2)->hours(12)->minute(0);
        $this->assertTrue($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(2)->hours(13)->minute(0);
        $this->assertTrue($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(2)->hours(14)->minute(0);
        $this->assertTrue($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(6)->hours(10)->minute(30);
        $this->assertTrue($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(2)->hours(11)->minute(59);
        $this->assertFalse($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(2)->hours(14)->minute(1);
        $this->assertFalse($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(1)->hours(13)->minute(0);
        $this->assertFalse($service->checkCourseIsActual($course, $date));

        $date = Carbon::today()->isoWeekday(1)->hours(13)->minute(0);
        $this->assertFalse($service->checkCourseIsActual($course, $date));

        $course->schedule = $schedule2;
        $date = Carbon::today()->isoWeekday(2)->hours(13)->minute(0);
        $this->assertFalse($service->checkCourseIsActual($course, $date));

        $course->schedule = $schedule3;
        $date = Carbon::today()->isoWeekday(2)->hours(13)->minute(0);
        $this->assertFalse($service->checkCourseIsActual($course, $date));
        $date = Carbon::today()->isoWeekday(6)->hours(13)->minute(0);
        $this->assertFalse($service->checkCourseIsActual($course, $date));
    }
}
