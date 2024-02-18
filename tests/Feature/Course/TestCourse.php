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

    public function test_course_checkin(): void
    {
        $response = $this->get('/api/checkin/123');

        $response->assertStatus(200);

    }
}
