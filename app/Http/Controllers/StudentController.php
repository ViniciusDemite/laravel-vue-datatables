<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;

class StudentController extends Controller
{
    public function index() {
        $paginate = request('paginate', 10);
        $searchTerm = request('q', '');

        $students = Student::with(['class', 'section'])
            ->search(trim($searchTerm))
            ->paginate($paginate);

        return StudentResource::collection($students);
    }
}
