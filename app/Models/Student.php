<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Student extends Model
{
    use HasFactory;

    public function getActiveClubId($student_id)
    {
        $student = Visitor::query()->where('student_id', $student_id)->orderByDesc('id')->first();
        return is_null($student) ? null : $student->club_id;
    }
}
