<?php

namespace Tests\Feature\Course;

use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class TestJournal extends TestCase
{

    public function test_journal_all(): void
    {
        $response = $this->get('/journal');

        $response->assertStatus(200);
        $response->assertContent("error");
    }
}
