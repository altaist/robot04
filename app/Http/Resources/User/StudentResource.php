<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Lesson\LessonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            ... parent::toArray($request),
            'courses' => $this->courses,
            'lessons' => $this->lessons,
            //'payments' => CoursResource::collection($this->whenLoaded('peyments')),
        ];
        //dd($result);

        return $result;
    }
}
