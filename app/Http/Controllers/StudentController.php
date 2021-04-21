<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Http\Resources\StudentResource;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $paginate = request('paginate', 10);
        $searchTerm = request('q', '');
        $selectedClass = request('selectedClass');
        $selectedSection = request('selectedSection');

        $sortDiraction = request('sort_diraction', 'desc');
        if (!in_array($sortDiraction, ['asc', 'desc'])) {
            $sortDiraction = 'desc';
        }

        $sortField = request('sort_field', 'created_at');
        if (!in_array($sortField, ['name', 'email', 'address', 'phone_number', 'created_at'])) {
            $sortField = 'created_at';
        }

        $students = Student::with(['class', 'section'])
            ->when($selectedClass, function($query) use ($selectedClass) {
                $query->where('class_id', $selectedClass);
            })
            ->when($selectedSection, function($query) use ($selectedSection) {
                $query->where('section_id', $selectedSection);
            })
            ->search(trim($searchTerm))
            ->orderBy($sortField, $sortDiraction)
            ->paginate($paginate);

        return StudentResource::collection($students);
    }

    public function allStudents() {
        return Student::pluck('id');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        
        return response()->noContent();
    }

    public function massDestroy(string $students)
    {
        $studentsArray = explode(',', $students);
        Student::whereKey($studentsArray)->delete();

        return response()->noContent();
    }

    public function export(string $students) {
        $studentsArray = explode(',', $students);

        return (new StudentExport($studentsArray))->download('students.xlsx');
    }
}
