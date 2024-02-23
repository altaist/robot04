<?php

namespace Tests\Feature\Edu;

use App\Models\Course;
use App\Services\Course\CourseService;
use Database\Seeders\edu\JournalSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class JournalTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(JournalSeeder::class);
    }

    public function test_journal_all(): void
    {
        $response = $this->get('/journal');

        $response->assertStatus(200);
    }
}
