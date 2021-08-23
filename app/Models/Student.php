<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function getActiveRoomId($student_id)
    {
        $student = Visitor::query()->where('student_id', $student_id)->orderByDesc('id')->first();
        return is_null($student) ? null : $student->room_id;
    }

    public function getActiveRoom($student_id)
    {
        $student = Visitor::query()->where('student_id', $student_id)->orderByDesc('id')->first();
        return is_null($student) ? null : $student->room_id;
    }
}
