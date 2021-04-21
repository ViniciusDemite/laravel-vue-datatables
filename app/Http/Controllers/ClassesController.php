<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassesResource;
use App\Models\Classes;

class ClassesController extends Controller
{
    public function index() {
        $classes = Classes::all();

        return ClassesResource::collection($classes);
    }
}
