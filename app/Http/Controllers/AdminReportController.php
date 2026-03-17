<?php

namespace App\Http\Controllers;

use App\Models\Survey;

class AdminReportController extends Controller
{
    public function index()
    {
        $surveys = Survey::query()
            ->withCount('responses')
            ->withMax('responses', 'created_at')
            ->orderBy('year', 'desc')
            ->orderBy('name')
            ->get();

        return view('admin.reports', compact('surveys'));
    }
}
