<?php

namespace App\Http\Controllers\Backend;
use App\Helpers\ClientHelper;
use App\Models\Backend\Project;


use App\Models\Backend\Service; // Rename if needed (e.g., Renewal)
use Illuminate\Http\Request;
use DB;

class RenewalController 
{
    // List all renewals
    public function index()
    {
        // $services = Service::orderBy('expiry_date')->get();
        // $services = Service::all(); // Or paginate() if needed
        // $services = Service::with('client')->get();
        $services = Service::with('client')->paginate(5);
        return view('backend.renewals.manage', compact('services'));



        // return view('backend.renewals.manage');
    
    }

    // Show create form
    public function create()
    { 
        $clients = ClientHelper::getClientNames();
     
        $projects = DB::table('si_projects')->orderBy('project_name')->get(['id', 'project_name']);
        return view('backend.renewals.create', compact('projects','clients'));
    }

    // Store new renewal
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'project_id' => 'required|string',
    //         'service_type' => 'required|in:domain,hosting,application',
    //         'service_name' => 'required|string',
    //         'provider' => 'required|string',
    //         'expiry_date' => 'required|date',
    //         'renewal_cost' => 'nullable|numeric',
    //         'notes' => 'nullable|string',
    //     ]);

    //     Service::create($validated);
    //     return redirect()->route('admin.renewals.manage')->with('success', 'Renewal added!');
    // }


    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'client_id'    => 'required|exists:isar_clients,id',
            'project_id'   => 'required|exists:si_projects,id',
            'provider'     => 'required|string|max:50',
            'renewal_cost' => 'nullable|numeric',
            'notes'        => 'nullable|string',
         
            // 'services.domain.enabled' => 'nullable|boolean',
            // 'services.domain.name' => 'required_if:services.domain.enabled,1',
            // 'services.domain.expiry_date' => 'required_if:services.domain.enabled,1|date',
            // 'services.hosting.enabled' => 'nullable|boolean',
            // 'services.hosting.name' => 'required_if:services.hosting.enabled,1',
            // 'services.hosting.expiry_date' => 'required_if:services.hosting.enabled,1|date',
            // 'services.application.enabled' => 'nullable|boolean',
            // 'services.application.name' => 'required_if:services.application.enabled,1',
            // 'services.application.expiry_date' => 'required_if:services.application.enabled,1|date',
        ]);

        // Prepare service data
        $serviceData = [
            'client_id'    => $validated['client_id'],
            'project_id'   => $validated['project_id'],
            'provider'     => $validated['provider'] ?? null,
            'renewal_cost' => $validated['renewal_cost'] ?? null,
            'notes'        => $validated['notes'] ?? null,
        
            'd_service' => $request->input('services.domain.enabled', 0) ? 1 : 0,
            'd_name'    => $request->input('services.domain.name'),
            'd_exp'     => $request->input('services.domain.expiry_date'),
        
            'h_service' => $request->input('services.hosting.enabled', 0) ? 1 : 0,
            'h_ip'      => $request->input('services.hosting.name'),
            'h_exp'     => $request->input('services.hosting.expiry_date'),
        
            'a_service' => $request->input('services.application.enabled', 0) ? 1 : 0,
            'a_name'    => $request->input('services.application.name'),
            'a_exp'     => $request->input('services.application.expiry_date'),

             // Add creator and updater
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ];

        // Create the service record
        $service = Service::create($serviceData);
       
        // dd($serviceData);
            return redirect()->route('admin.renewals.manage')
            ->with('flash_success_addrenewal', 'Service renewal created successfully!');
        
    }

    // Show edit form
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $projects = DB::table('si_projects')->orderBy('project_name')->get();
        
        return view('backend.renewals.edit', compact('service', 'projects'));
    }

    // Update renewal
    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'project_id' => 'required|string',
    //         'service_type' => 'required|in:domain,hosting,application',
    //         'service_name' => 'required|string',
    //         'provider' => 'required|string',
    //         'expiry_date' => 'required|date',
    //         'renewal_cost' => 'nullable|numeric',
    //         'notes' => 'nullable|string',
    //     ]);

    //     Service::where('id', $id)->update($validated);
    //     return redirect()->route('admin.renewals.manage')->with('success', 'Renewal updated!');
    // }
    // Update the service
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'client_id'    => 'required|exists:isar_clients,id',
            'project_id'   => 'required|exists:si_projects,id',
            'provider'     => 'required|string|max:50',
            'renewal_cost' => 'nullable|numeric',
            'notes'        => 'nullable|string',
        ]);

        // Prepare service data
        $serviceData = [
            'client_id'    => $validated['client_id'],
            'project_id'   => $validated['project_id'],
            'provider'     => $validated['provider'] ?? null,
            'renewal_cost' => $validated['renewal_cost'] ?? null,
            'notes'        => $validated['notes'] ?? null,
        
            'd_service'     => $request->input('services.domain.enabled', 0) ? 1 : 0,
            'd_name'        => $request->input('services.domain.name'),
            'd_exp'         => $request->input('services.domain.expiry_date'),
        
            'h_service'     => $request->input('services.hosting.enabled', 0) ? 1 : 0,
            'h_ip'          => $request->input('services.hosting.name'),
            'h_exp'         => $request->input('services.hosting.expiry_date'),
        
            'a_service'     => $request->input('services.application.enabled', 0) ? 1 : 0,
            'a_name'        => $request->input('services.application.name'),
            'a_exp'         => $request->input('services.application.expiry_date'),

            'updated_by' => auth()->id(),
        ];

        // Update the service record
        $service = Service::findOrFail($id);
        $service->update($serviceData);
    
        return redirect()->route('admin.renewals.manage')
            ->with('flash_success_updaterenewal', 'Service renewal updated successfully!');
    }

    // Delete renewal
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->route('admin.renewals.manage')->with('success', 'Renewal deleted!');
    }


    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $services = Service::with('client')
            ->where(function($q) use ($query) {
                $q->where('d_name', 'LIKE', "%{$query}%")
                ->orWhere('h_ip', 'LIKE', "%{$query}%")
                ->orWhere('a_name', 'LIKE', "%{$query}%");
            })
            ->paginate(5);
        
        return view('backend.renewals.manage', compact('services'));
    }

    // Export (Optional)
    public function export()
    {
        // Implement CSV/PDF export logic
    }
}