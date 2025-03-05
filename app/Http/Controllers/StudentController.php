<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // 1. Retrieve filter values
        $order = $request->input('order', 'alphabet');
        $search = $request->input('search');
        $location = $request->input('location');
        $land = $request->input('land');

        // 2. Build the query for stages
        $query = Stage::query()->with('company', 'logo');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tasks', 'like', "%{$search}%")
                  ->orWhereHas('company', function ($q2) use ($search) {
                      $q2->where('company_name', 'like', "%{$search}%");
                  });
            });
        }

        if ($location) {
            $query->whereHas('company', function ($q) use ($location) {
                $q->where('town', $location);
            });
        }

        if ($land) {
            $query->whereHas('company', function ($q) use ($land) {
                $q->where('zip', $land);
            });
        }

        if ($order === 'alphabet') {
            $query->orderBy('title');
        } else {
            // 'recent'
            $query->orderByDesc('created_at');
        }

        // 3. Paginate the stages
        $stages = $query->paginate(6);

        // 4. Get distinct locations and lands (from Stage -> Company)
        $locations = Stage::with('company')
            ->get()
            ->pluck('company.town')
            ->filter()
            ->unique()
            ->values();

        $lands = Stage::with('company')
            ->get()
            ->pluck('company.zip')
            ->filter()
            ->unique()
            ->values();

        // 5. Determine the selected stage (if any)
        $selectedStageId = $request->input('selectedStage');
        $selectedStage = null;
        if ($selectedStageId) {
            $selectedStage = Stage::with('company', 'logo')->find($selectedStageId);
        }

        // 6. Return the view
        return view('student.home', [
            'stages' => $stages,
            'locations' => $locations,
            'lands' => $lands,
            'selectedStage' => $selectedStage,
        ]);
    }
}
