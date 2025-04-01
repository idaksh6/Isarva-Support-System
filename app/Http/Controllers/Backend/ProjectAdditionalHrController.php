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
        $validated = $request->validate([
            'project_id' => 'required|exists:si_projects,id',
            'additional_hrs' => 'required|array',
            'additional_hrs.*.date' => 'required|date',
            'additional_hrs.*.description' => 'required|string',
            'additional_hrs.*.hrs' => 'required|numeric|min:0',
            'additional_hrs.*.comments' => 'nullable|string',
        ]);
    
        DB::beginTransaction();
        try {
            $existingIds = [];
            $newIds = [];
            
            foreach ($request->additional_hrs as $hrData) {
                if (!empty($hrData['id'])) {
                    // Update existing record
                    $record = ProjectAdditionalHours::find($hrData['id']);
                    if ($record) {
                        $record->update([
                            'date' => $hrData['date'],
                            'description' => $hrData['description'],
                            'hrs' => $hrData['hrs'],
                            'comments' => $hrData['comments'] ?? null,
                            'updated_by' => auth()->id(),
                        ]);
                        $existingIds[] = $hrData['id'];
                    }
                } else {
                    // Create new record
                    $newRecord = ProjectAdditionalHours::create([
                        'project_id' => $request->project_id,
                        'date' => $hrData['date'],
                        'description' => $hrData['description'],
                        'hrs' => $hrData['hrs'],
                        'comments' => $hrData['comments'] ?? null,
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                    ]);
                    $newIds[] = $newRecord->id;
                }
            }
    
            // Combine all IDs we want to keep
            $idsToKeep = array_merge($existingIds, $newIds);
            
            // Only delete if we have records to protect
            if (!empty($idsToKeep)) {
                ProjectAdditionalHours::where('project_id', $request->project_id)
                    ->whereNotIn('id', $idsToKeep)
                    ->delete();
            }
    
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Additional hours saved successfully!',
                'saved_ids' => $idsToKeep // For debugging
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to save additional hours: ' . $e->getMessage()
            ], 500);
        }
    }

}
