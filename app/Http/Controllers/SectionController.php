<?php

namespace App\Http\Controllers;

use App\Http\Resources\SectionsResource;
use App\Models\Section;

class SectionController extends Controller
{
    public function index() {
        $classId = request('class_id');

        $sections = Section::when($classId, function($query) use ($classId) {
            $query->where('class_id', $classId);
        })
        ->get();

        return SectionsResource::collection($sections);
    }
}
