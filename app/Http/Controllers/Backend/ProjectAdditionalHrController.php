<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ProjectAdditionalHours;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\Project;

class ProjectAdditionalHrController extends Controller
{
    public function index($projectId)
    {
        $additionalHours = ProjectAdditionalHours::where('project_id', $projectId)
            ->get()
            ->map(function ($item) {
                $item->date = $item->date->format('Y-m-d');
                return $item;
            });
        
        return response()->json($additionalHours);
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:si_projects,id',
            'additional_hrs' => 'required|array',
            'additional_hrs.*.date' => 'required|date',
            'additional_hrs.*.description' => 'required|string',
            'additional_hrs.*.hrs' => 'required|numeric|min:0',
            'additional_hrs.*.comments' => 'nullable|string',
        ]);

        // Delete existing entries
        ProjectAdditionalHours::where('project_id', $request->project_id)->delete();

        // Create new entries
        foreach ($request->additional_hrs as $hrData) {
            ProjectAdditionalHours::create([
                'project_id' => $request->project_id,
                'date' => $hrData['date'],
                'description' => $hrData['description'],
                'hrs' => $hrData['hrs'],
                'comments' => $hrData['comments'] ?? null,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Additional hours saved successfully!'
        ]);
    }

    

}
