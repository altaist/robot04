<?php

namespace Tests\Feature\Edu;

use App\Models\Course;
use App\Models\Journal;
use App\Models\User;
use App\Services\Course\CourseService;
use Database\Seeders\edu\JournalSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\Feature\BaseTestCase;
use Tests\TestCase;

class JournalTest extends BaseTestCase
{

    public function test_journal_all(): void
    {
        $response = $this->get('/journal');

        $response->assertStatus(200);
    }

    public function test_course_checkin(): void
    {
        Journal::query()->delete();
        $user = User::find(1);
        $user->first_name = 'Егор';
        $user->skud_key = '2218233164';
        $user->save();
        $response = $this->get('/api/checkin/card/2218233164');

        $response->assertStatus(200);
        $response->assertContent("Егор");

        $this->assertEquals(1, Journal::count());
        $response = $this->get('/api/checkin/card/2218233164');
        $this->assertEquals(1, Journal::count());

        $user->skud_key = '123';
        $user->save();
        $response = $this->get('/api/checkin/card/123');
        $response->assertContent("Егор");
        $this->assertEquals(1, Journal::count());

        $user = User::find(2);
        $user->first_name = 'Петя';
        $user->skud_key = '345';
        $user->save();
        $response = $this->get('/api/checkin/card/345');
        $response->assertContent("Петя");
        $response = $this->get('/api/checkin/card/345');
        $response->assertContent("Петя");
        $this->assertEquals(2, Journal::count());


    }
}
