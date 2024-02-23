<?php

namespace Tests\Feature\Edu;

use App\Models\Journal;
use App\Models\Lesson;
use Tests\Feature\BaseTestCase;

class LessonTest extends BaseTestCase
{
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
}