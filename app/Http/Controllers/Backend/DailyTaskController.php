<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ProjectHelper;
use App\Helpers\TicketHelper;
use Illuminate\Support\Facades\Validator;
use App\Models\Backend\Project;
use App\Models\Backend\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\DailyTask;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage; // If needed to get the favicon path



class DailyTaskController extends Controller
{
     

    public function index(Request $request)
    {
        $projects = ProjectHelper::getProjectNames();
        $tickets = TicketHelper::getTicketNames();
        $user = Auth::user();
    
        // $query = DailyTask::with('user');
        $query = DailyTask::with('user')->whereDate('created_at', now()->toDateString());

    
        if ($user->role != 1) {
            $query->where('user_id', $user->id);
        }
    
        $tasks = $query->orderBy('created_at', 'desc')->paginate(20);
    
        foreach ($tasks as $task) {
            $task->status_text = $task->getStatusText();
        }
    
        return view('backend.daily_task.daily_task', compact('projects', 'tickets', 'tasks'));
    }
    
    public function create()
    {
        $projects = ProjectHelper::getProjectNames();
        $tickets = TicketHelper::getTicketNames();
        
        return view('backend.daily_task.create', compact('projects', 'tickets'));
    }
 
    // private function hasSubmittedToday($userId): bool
    // {
    //     return DailyTask::where('user_id', $userId)
    //         ->whereDate('created_at', today())
    //         ->exists();
    // }



    public function store(Request $request)
    {
        // Only one task per day 
        // $user = Auth::user();
    
        // // Check if user already submitted a task today
        // $existingTask = DailyTask::where('user_id', $user->id)
        //     ->whereDate('created_at', today())
        //     ->first();
        
        // if ($existingTask) {
        //     return response()->json([
        //         'error' => 'Only one daily task submission allowed per day'
        //     ], 422);
        // }

         // validation
        $validator = Validator::make($request->all(), [
            'type.*' => 'required|in:1,2',
            'status.*' => 'required|integer|between:1,7',
            'description.*' => 'required|string',
            'notes.*' => 'nullable|string',
            'project_id.*' => 'required|required_if:type.*,1|exists:si_projects,id',
            'ticket_id.*' => 'required|required_if:type.*,2|exists:isar_tickets,id',
        ], [
            'comments.*.required' => 'Each comment field is required.',
            'description.*.required' => 'Description field id required',
            'type.*.required'  => 'Type field is required',
            'status.*.required' => 'The status field is required.',
            'status.*.between' => 'Choose the status under the available option.',
            'project_id.*.required'=> 'Project name  field is required',
            'ticket_id.*.required'=> 'Ticket name field is required',
            'project_id.*.required_if' => 'Project selection is required when type is Project.',
            'ticket_id.*.required_if' => 'Ticket selection is required when type is Ticket.',
            'project_id.*.exists' => 'Invalid project selected.',
            'ticket_id.*.exists' => 'Invalid ticket selected.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $userId = Auth::id();
        $tasks = [];
    
        // Reorganize the input data into a more manageable structure
        foreach ($request->type as $index => $type) {
            $task = [
                'type' => $type,
                'description' => $request->description[$index],
                'notes' => $request->notes[$index] ?? null,
                'status' => $request->status[$index],
                'project_ticket_id' => null,
                'project_ticket_name' => null,
            ];
    
            if ($type == '1' && isset($request->project_id[$index])) {
                $project = Project::find($request->project_id[$index]);
                if ($project) {
                    $task['project_ticket_id'] = $project->id;
                    $task['project_ticket_name'] = $project->project_name;
                }
            } elseif ($type == '2' && isset($request->ticket_id[$index])) {
                $ticket = Ticket::find($request->ticket_id[$index]);
                if ($ticket) {
                    $task['project_ticket_id'] = $ticket->id;
                    $task['project_ticket_name'] = $ticket->title;
                }
            }
    
            $tasks[] = $task;
        }
    
        // Create all tasks in a transaction
        DB::transaction(function () use ($tasks, $userId) {
            foreach ($tasks as $task) {
                DailyTask::create([
                    'user_id' => $userId,
                    'type' => $task['type'],
                    'project_ticket_id' => $task['project_ticket_id'],
                    'project_ticket_name' => $task['project_ticket_name'],
                    'description' => $task['description'],
                    'notes' => $task['notes'],
                    'status' => $task['status'],
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);
            }
        });

        // Google chat design
    
        // $user = Auth::user(); // Logged-in user

        // $widgets = [];
        // $counter = 1;
        
        // foreach ($tasks as $task) {
        //     if (empty($task['project_ticket_name'])) {
        //         $typeLabel = 'Project/Ticket';
        //         $projectTicketName = 'N/A';
        //     } else {
        //         $typeLabel = $task['type'] == 1 ? 'Project: ' : 'Ticket: ';
        //         $projectTicketName = $task['project_ticket_name'];
        //     }
        
        //     $widgets[] = [
        //         'textParagraph' => [
        //             'text' => "<div style='margin-bottom:16px;padding:16px;background-color:#ffffff;border-radius:8px;border:1px solid #e5e7eb;box-shadow:0 1px 3px rgba(0,0,0,0.05);'>"
        //                     . "<div style='display:flex;justify-content:space-between;margin-bottom:8px;'>"
        //                     . "<div style='font-size:14px;color:#4f46e5;font-weight:600;'>"
        //                     . "<span style='background-color:#f3f4f6;padding:4px 8px;border-radius:4px;'>"
        //                     . "{$counter}. {$typeLabel}"
        //                     . "</span>"
        //                     . "</div>"
        //                     . "<div style='font-size:14px;color:#1f2937;font-weight:500;'>"
        //                     . $projectTicketName
        //                     . "</div>"
        //                     . "</div>"
        //                     . "<div style='font-size:14px;color:#374151;padding:8px 0;border-top:1px dashed #e5e7eb;margin-top:8px;'>"
        //                     . "<div style='font-weight:600;color:#4f46e5;margin-bottom:4px;'>Today's Work:</div>"
        //                     . "<div style='color:#4b5563;line-height:1.5;'>"
        //                     . nl2br($task['description'])
        //                     . "</div>"
        //                     . "</div>"
        //                     . "</div>"
        //         ]
        //     ];
        //     $counter++;
        // }
        
        // $cardData = [
        //     'cards' => [
        //         [
        //             'header' => [
        //                 'title' => 'DAILY TASK SUMMARY',
        //                 'subtitle' => "<span style='color:#6b7280;font-weight:500;'>Employee: </span><span style='color:#4f46e5;font-weight:600;'>".$user->name."</span>",
        //                 'imageUrl' => 'https://isarvait.com/wp-content/uploads/2024/08/Favicon.png',
        //                 'imageStyle' => 'IMAGE',
        //                 'imageAltText' => 'Company Logo'
        //             ],
        //             'sections' => [
        //                 [
        //                     'header' => "<span style='color:#4f46e5;'>Today's Tasks</span>",
        //                     'widgets' => array_merge(
        //                         [
        //                             [
        //                                 'textParagraph' => [
        //                                     'text' => "<div style='font-size:13px;color:#6b7280;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e5e7eb;'>"
        //                                             . "<span style='font-weight:600;'>".date('l, F jS Y')."</span> | "
        //                                             . "<span style='background-color:#f3f4f6;padding:2px 6px;border-radius:4px;'>"
        //                                             . count($tasks)." tasks"
        //                                             . "</span>"
        //                                             . "</div>"
        //                                 ]
        //                             ]
        //                         ],
        //                         $widgets
        //                     )
        //                 ]
        //             ]
        //         ]
        //     ]
        // ];
        
        // // Send to Google Chat
        // $response = Http::post(
        //     'https://chat.googleapis.com/v1/spaces/-tCJNcAAAAE/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=XYr3bHhEf9fTHUjS6DKDgLNNpi8l7Dk1skf2IknQQWs',
        //     $cardData
        // );

        $user = Auth::user();

        // Build the message structure
        $message = [
            'cardsV2' => [
                [
                    'cardId' => 'taskSummaryCard',
                    'card' => [
                        'header' => [
                            'title' => 'DAILY TASK SUMMARY',
                            'subtitle' => "Employee: {$user->name}",
                            'imageUrl' => 'https://isarvait.com/wp-content/uploads/2024/08/Favicon.png',
                            'imageType' => 'SQUARE' // This ensures the full logo shows
                        ],
                        'sections' => [
                            [
                                'header' => "Today's Tasks - " . date('l, F jS Y'),
                                'widgets' => []
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        // Add summary widget
        $message['cardsV2'][0]['card']['sections'][0]['widgets'][] = [
            'decoratedText' => [
                'text' => 'Total Tasks: ' . count($tasks),
                'topLabel' => 'SUMMARY',
                'wrapText' => true
            ]
        ];
        
     
        foreach ($tasks as $index => $task) {
            $typeLabel = $task['type'] == 1 ? 'PROJECT' : 'TICKET';
            $emoji = $task['type'] == 1 ? '🔷' : '🟢';
            $name = strtoupper($task['project_ticket_name'] ?? 'N/A');
            $description = trim($task['description']);
            $formattedDescription = preg_replace('/\r\n|\r|\n/', "\n", $description);
        
            // Push a new section for each task so we can use 'header' with large font
            $message['cardsV2'][0]['card']['sections'][] = [
                'header' => "{$emoji} " . ($index + 1) . ". {$typeLabel}: {$name}", // Big font here!
                'widgets' => [
                    [
                        'textParagraph' => [
                            'text' => "<b>Description:</b><br>{$formattedDescription}"
                        ]
                    ]
                ]
            ];
        }
        
        
        // Send to Google Chat API
        $response = Http::post(
            'https://chat.googleapis.com/v1/spaces/-tCJNcAAAAE/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=XYr3bHhEf9fTHUjS6DKDgLNNpi8l7Dk1skf2IknQQWs',
            ['cardsV2' => $message['cardsV2']]
        );
        



        // Return a response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully!'
            ]);
        }
        // return redirect()->back()->with('flash_success_dailytask', 'Daily Task added successfully.');
    }

    // public function edit($id)
    // {
    //     $task = DailyTask::findOrFail($id);
    //     $projects = ProjectHelper::getProjectNames();
    //     $tickets = TicketHelper::getTicketNames();

    //     return view('backend.daily_task.edit', compact('task', 'tasks', 'projects', 'tickets'));

    // }
    // public function edit($id)
    // {
    //     $mainTask = DailyTask::findOrFail($id);
    //     $userId = Auth::id();
        
    //     // Get all tasks from the same day by the same user
    //     $tasks = DailyTask::where('user_id', $userId)
    //         ->whereDate('created_at', $mainTask->created_at->toDateString())
    //         ->orderBy('created_at')
    //         ->get();
            
    //     $projects = ProjectHelper::getProjectNames();
    //     $tickets = TicketHelper::getTicketNames();
        
    //     return view('backend.daily_task.edit', [
    //         'task' => $mainTask,
    //         'additionalTasks' => $tasks->where('id', '!=', $id), // All other tasks from the same day
    //         'projects' => $projects,
    //         'tickets' => $tickets
    //     ]);
    // }
   
    public function edit($id)
    {
        $mainTask = DailyTask::findOrFail($id);
        
        // Check if the current user owns the task
        if ($mainTask->user_id != Auth::id()) {
            abort(403, 'You are not authorized to edit this task as it does not belong to you.');
        }
        
        $taskUserId = $mainTask->user_id;
        
        // Get all tasks from the same day by the same user who owns the main task
        $tasks = DailyTask::where('user_id', $taskUserId)
            ->whereDate('created_at', $mainTask->created_at->toDateString())
            ->orderBy('created_at')
            ->get();
            
        $projects = ProjectHelper::getProjectNames();
        $tickets = TicketHelper::getTicketNames();
        
        return view('backend.daily_task.edit', [
            'task' => $mainTask,
            'additionalTasks' => $tasks->where('id', '!=', $id),
            'projects' => $projects,
            'tickets' => $tickets
        ]);
    }
            

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'type' => 'required|in:1,2',
    //         'status' => 'required|integer|between:1,7',
    //         'description' => 'required|string',
    //         'notes' => 'nullable|string',
    //         'project_id' => 'required_if:type,1|exists:si_projects,id',
    //         'ticket_id' => 'required_if:type,2|exists:isar_tickets,id',
    //     ], [
    //         'description.required' => 'Description field is required',
    //         'type.required' => 'Type field is required',
    //         'status.required' => 'The status field is required.',
    //         'status.between' => 'Choose the status under the available option.',
    //         'project_id.required_if' => 'Project selection is required when type is Project.',
    //         'ticket_id.required_if' => 'Ticket selection is required when type is Ticket.',
    //         'project_id.exists' => 'Invalid project selected.',
    //         'ticket_id.exists' => 'Invalid ticket selected.',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }
    
    //     $task = DailyTask::findOrFail($id);
    //     $userId = Auth::id();
    
    //     $projectTicketId = null;
    //     $projectTicketName = null;
    
    //     if ($request->type == '1') {
    //         $project = Project::find($request->project_id);
    //         if ($project) {
    //             $projectTicketId = $project->id;
    //             $projectTicketName = $project->project_name;
    //         }
    //     } elseif ($request->type == '2') {
    //         $ticket = Ticket::find($request->ticket_id);
    //         if ($ticket) {
    //             $projectTicketId = $ticket->id;
    //             $projectTicketName = $ticket->title;
    //         }
    //     }
    
    //     $task->update([
    //         'type' => $request->type,
    //         'project_ticket_id' => $projectTicketId,
    //         'project_ticket_name' => $projectTicketName,
    //         'description' => $request->description,
    //         'notes' => $request->notes,
    //         'status' => $request->status,
    //         'updated_by' => $userId,
    //     ]);
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Task updated successfully!'
    //     ]);
    // }


    public function update(Request $request, $id)
    {

        // First validate ownership of all existing tasks being updated
    if ($request->has('task_ids')) {
        foreach ($request->task_ids as $taskId) {
            if ($taskId) {
                $task = DailyTask::find($taskId);
                if ($task && $task->user_id != Auth::id()) {
                    return response()->json([
                        'errors' => [
                            'authorization' => ['You are not authorized to update task ID: '.$taskId]
                        ]
                    ], 403);
                }
            }
        }
    }
    
        $validator = Validator::make($request->all(), [
            'type.*' => 'required|in:1,2',
            'status.*' => 'required|integer|between:1,7',
            'description.*' => 'required|string',
            'notes.*' => 'nullable|string',
            'project_id.*' => 'required_if:type.*,1|exists:si_projects,id',
            'ticket_id.*' => 'required_if:type.*,2|exists:isar_tickets,id',
            'task_ids.*' => 'nullable|exists:si_daily_tasks,id',
        ], [
            'description.*.required' => 'Description field is required',
            'type.*.required' => 'Type field is required',
            'status.*.required' => 'The status field is required.',
            'status.*.between' => 'Choose the status under the available option.',
            'project_id.*.required_if' => 'Project selection is required when type is Project.',
            'ticket_id.*.required_if' => 'Ticket selection is required when type is Ticket.',
            'project_id.*.exists' => 'Invalid project selected.',
            'ticket_id.*.exists' => 'Invalid ticket selected.',
            'task_ids.*.exists' => 'Invalid task ID provided.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $userId = Auth::id();
        $tasks = [];
        $taskIdsToKeep = [];
    
        // Reorganize the input data
        foreach ($request->type as $index => $type) {
            $taskData = [
                'type' => $type,
                'description' => $request->description[$index],
                'notes' => $request->notes[$index] ?? null,
                'status' => $request->status[$index],
                'project_ticket_id' => null,
                'project_ticket_name' => null,
                'is_new' => !isset($request->task_ids[$index]),
                'task_id' => $request->task_ids[$index] ?? null,
            ];
    
            if ($type == '1' && isset($request->project_id[$index])) {
                $project = Project::find($request->project_id[$index]);
                if ($project) {
                    $taskData['project_ticket_id'] = $project->id;
                    $taskData['project_ticket_name'] = $project->project_name;
                }
            } elseif ($type == '2' && isset($request->ticket_id[$index])) {
                $ticket = Ticket::find($request->ticket_id[$index]);
                if ($ticket) {
                    $taskData['project_ticket_id'] = $ticket->id;
                    $taskData['project_ticket_name'] = $ticket->title;
                }
            }
    
            $tasks[] = $taskData;
            if (isset($request->task_ids[$index])) {
                $taskIdsToKeep[] = $request->task_ids[$index];
            }
        }
    
        // Update all tasks in a transaction
        DB::transaction(function () use ($tasks, $userId, $id, $taskIdsToKeep) {
            // Get the original task's creation date
            $originalTask = DailyTask::findOrFail($id);
            $createdAt = $originalTask->created_at;
            
            // Delete tasks that were removed from the form
            DailyTask::where('user_id', $userId)
                ->whereDate('created_at', $createdAt->toDateString())
                ->whereNotIn('id', $taskIdsToKeep)
                ->delete();
    
            foreach ($tasks as $task) {
                if ($task['is_new']) {
                    // Create new task
                    DailyTask::create([
                        'user_id' => $userId,
                        'type' => $task['type'],
                        'project_ticket_id' => $task['project_ticket_id'],
                        'project_ticket_name' => $task['project_ticket_name'],
                        'description' => $task['description'],
                        'notes' => $task['notes'],
                        'status' => $task['status'],
                        'created_at' => $createdAt, // Use the same created_at as the original task
                        'updated_at' => now(),
                        'created_by' => $userId,
                        'updated_by' => $userId,
                    ]);
                } else {
                    // Update existing task
                    DailyTask::where('id', $task['task_id'])
                        ->update([
                            'type' => $task['type'],
                            'project_ticket_id' => $task['project_ticket_id'],
                            'project_ticket_name' => $task['project_ticket_name'],
                            'description' => $task['description'],
                            'notes' => $task['notes'],
                            'status' => $task['status'],
                            'updated_by' => $userId,
                            'updated_at' => now(),
                        ]);
                }
            }
        });
    
        $user = Auth::user();
        $message = [
            'cardsV2' => [
                [
                    'cardId' => 'updatedTaskSummaryCard',
                    'card' => [
                        'header' => [
                            'title' => 'UPDATED DAILY TASKS SUMMARY',
                            'subtitle' => "Employee: {$user->name}",
                            'imageUrl' => 'https://isarvait.com/wp-content/uploads/2024/08/Favicon.png',
                            'imageType' => 'SQUARE'
                        ],
                        'sections' => [
                            [
                                'header' => "Updated Tasks - " . date('l, F jS Y'),
                                'widgets' => [
                                    [
                                        'decoratedText' => [
                                            'text' => 'Total Tasks: ' . count($tasks),
                                            'topLabel' => 'SUMMARY',
                                            'wrapText' => true
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    
        foreach ($tasks as $index => $task) {
            $typeLabel = $task['type'] == 1 ? 'PROJECT' : 'TICKET';
            $emoji = $task['type'] == 1 ? '🔷' : '🟢';
            $name = strtoupper($task['project_ticket_name'] ?? 'N/A');
            $description = trim($task['description']);
            $formattedDescription = preg_replace('/\r\n|\r|\n/', "\n", $description);
        
            $message['cardsV2'][0]['card']['sections'][] = [
                'header' => "{$emoji} " . ($index + 1) . ". {$typeLabel}: {$name}",
                'widgets' => [
                    [
                        'textParagraph' => [
                            'text' => "<b>Description:</b><br>{$formattedDescription}"
                        ]
                    ]
                ]
            ];
        }
    
        // Send to Google Chat API
        $response = Http::post(
            'https://chat.googleapis.com/v1/spaces/-tCJNcAAAAE/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=XYr3bHhEf9fTHUjS6DKDgLNNpi8l7Dk1skf2IknQQWs',
            ['cardsV2' => $message['cardsV2']]
        );
    
        return response()->json([
            'success' => true,
            'message' => 'Tasks updated successfully!'
        ]);
    }


    public function exportPdf()
    {
        $user = Auth::user();
        $query = DailyTask::with('user')->whereDate('created_at', now()->toDateString());
    
        if ($user->role != 1) {
            $query->where('user_id', $user->id);
        }
    
        $tasks = $query->orderBy('user_id')->get()->groupBy('user_id');
    
        foreach ($tasks as $userId => $groupedTasks) {
            foreach ($groupedTasks as $task) {
                $task->status_text = $task->getStatusText();
                $task->status_badge = $task->getStatusBadgeAttribute(); // Optional if needed manually
                
                // Rendered HTML already
            }
        }
    
        $pdf = Pdf::loadView('backend.daily_task.export_pdf', compact('tasks'))
                  ->setPaper('a4', 'landscape');
    
        return $pdf->download('Daily_Tasks_' . now()->format('d_m_Y') . '.pdf');
    }
    
}
