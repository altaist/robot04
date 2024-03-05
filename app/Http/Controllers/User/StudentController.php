<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\StudentResource;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::get();
        return $this->inertiaFromResource('\Teacher\Student', StudentResource::collection($students));
    }

    public function studentsForCourse()
    {
        $students = User::get();
        return $this->inertiaFromResource('\Teacher\Student', StudentResource::collection($students));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->inertiaFromResource('Teacher/Student', StudentResource::make($user));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ];

        $validated = $request->validate($rules);
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];

        $user->save();
        return new StudentResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
