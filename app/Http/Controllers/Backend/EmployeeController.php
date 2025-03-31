<?php

namespace App\Http\Controllers\Backend;
use App\Models\Backend\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\User;
use Illuminate\Http\Request;

class EmployeeController
{
    //
    public function members(){
       
        
        // $employees = Employee::all(); // Fetch all employee from the database
        $employees = User::all(); // Fetch all employee from the database
        return view('backend.our-employee.members', compact('employees'));
    }


    public function search(Request $request)
    {
        $q = $request->input('q');

        $employees = User::where('name', 'like', '%' . $q . '%')
            ->orWhere('joining_date', 'like', '%' . $q . '%')
            ->orWhere('user_name', 'like', '%' . $q . '%')
            ->orWhere('department', 'like', '%' . $q . '%')
            ->orWhere('designation', 'like', '%' . $q . '%')
            ->orWhere('status', 'like', '%' . $q . '%')
            ->get();

        return view('backend.our-employee.members', compact('employees', 'q'));
    }

  /** Store the Employee Information - Author RI - 03-03-2025 */
//   public function store(Request $request)
//   {
   
//     $request->validate([
//         'name'         => 'required|string|max:100',
//         'employee_id'  => 'nullable|string|max:200|unique:si_users,employee_id',
//         'joining_date' => 'required|date',
//         'user_name'    => 'required|string|max:100',
//         'password'     => 'required|string|min:1',
//         'email_id'     => 'required|email|max:40|unique:si_users,email_id',
//         'phone'        => 'required|string|max:30',
//         'department'   => 'required|integer|in:1,2,3,4,5',
//         'designation'  => 'required|integer|in:1,2,3,4,5,6,7,8,9,10',
//         'status'       => 'required|integer|in:1,2',
//         'role'         => 'required|integer|in:1,2,3,4',
//         'webhook_url'  => 'nullable|string|max:255',
//         'address'      => 'required|string|max:50',
//         'description'  => 'nullable|string',
//         'profile_image'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
//     ], [
//         'name.required' => 'The employee name is required.',
//         'name.string'   => 'The employee name must be a valid string.',
//         'name.max'      => 'The employee name cannot exceed 100 characters.',
    
//         'employee_id.string' => 'Employee ID must be a valid string.',
//         'employee_id.max'    => 'Employee ID cannot exceed 200 characters.',
//         'employee_id.unique' => 'This Employee ID is already registered.',
    
//         'joining_date.required' => 'The joining date is required.',
//         'joining_date.date'     => 'The joining date must be a valid date.',
    
//         'user_name.required' => 'The user name is required.',
//         'user_name.string'   => 'The user name must be a valid string.',
//         'user_name.max'      => 'The user name cannot exceed 100 characters.',
     
//         'password.required' => 'The password is required.',
//         'password.string'   => 'The password must be a valid string.',
//         'password.min'      => 'The password must be at least 1 character long.',
    
//         'email_id.required' => 'The email ID is required.',
//         'email_id.email'    => 'Please enter a valid email address.',
//         'email_id.max'      => 'The email ID cannot exceed 40 characters.',
//         'email_id.unique'   => 'This email ID is already registered.',
    
//         'phone.required' => 'The phone number is required.',
//         'phone.string'   => 'The phone number must be a valid string.',
//         'phone.max'      => 'The phone number cannot exceed 30 characters.',
    
//         'department.required' => 'The department is required.',
//         'department.integer'  => 'The department must be a valid integer.',
//         'department.in'       => 'The selected department is invalid.',
    
//         'designation.required' => 'The designation is required.',
//         'designation.in'       => 'The selected designation is invalid.',
    
//         'status.required' => 'The status is required.',
//         'status.in'       => 'The selected status is invalid.',
    
//         'role.required' => 'The role is required.',
//         'role.in'       => 'The selected role is invalid.',
    
//         'address.required' => 'The address is required.',
//         'address.string'   => 'The address must be a valid string.',
//         'address.max'      => 'The address cannot exceed 50 characters.',
    
//         'profile_image.image' => 'The profile image must be a valid image file.',
//         'profile_image.mimes' => 'The profile image must be of type jpeg, png, or jpg.',
//         'profile_image.max'   => 'The profile image cannot exceed 2048KB.',
//     ]);
    
  
//       $employee = new Employee();
//       $employee->name = $request->name;
//       $employee->employee_id = $request->employee_id;
//       $employee->joining_date = $request->joining_date;
//       $employee->user_name = $request->user_name;
//      // $employee->password = Hash::make($request->password);
//      if ($request->password) {
//         $employee->password = bcrypt($request->password);
//       }
//       $employee->email_id = $request->email_id;
//       $employee->phone = $request->phone;
//       $employee->department = $request->department;
//       $employee->designation = $request->designation;
//       $employee->status = $request->status;
//       $employee->role = $request->role;
//       $employee->webhook_url = $request->webhook_url;
//       $employee->address = $request->address;
//       $employee->description = $request->description;
//       $employee->created_by = Auth::id();
//       $employee->updated_by = Auth::id();
  
//       if ($request->hasFile('profile_image')) {
//           $fileName = time() . '.' . $request->profile_image->extension();
//           $filePath = public_path('images/employee_profiles/');
  
//           if (!file_exists($filePath)) {
//               mkdir($filePath, 0777, true);
//           }
  
//           $request->profile_image->move($filePath, $fileName);
//           $employee->profile_image = 'images/employee_profiles/' . $fileName;
//       }
  
//       $employee->save();

  
//     if ($request->ajax()) {
//         return response()->json(['success' => 'Employee added successfully!']);
//     }

//     // return redirect()->route('admin.our-employee.members')
//     //     ->with('success', 'Employee added successfully!');
// }


        /** Store the Employee Information - Updated to Store in Users Table */
        public function store(Request $request)
        {
            $request->validate([
                'name'         => 'required|string|max:100',
                'employee_id'  => 'nullable|string|max:200|unique:users,employee_id',
                'joining_date' => 'required|date',
                'user_name'    => 'required|string|max:100',
                'password'     => 'required|string|min:1',
                'email_id'        => 'required|email|max:40|unique:users,email',
                'phone'        => 'required|string|max:30',
                'department'   => 'required|integer|in:1,2,3,4,5',
                'designation'  => 'required|integer|in:1,2,3,4,5,6,7,8,9,10',
                'status'       => 'required|integer|in:1,2',
                'role'         => 'required|integer|in:1,2,3,4',
                'webhook_url'  => 'nullable|string|max:255',
                'address'      => 'required|string|max:50',
                'description'  => 'nullable|string',
                'profile_image'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'name.required' => 'The employee name is required.',
                'employee_id.unique' => 'This Employee ID is already registered.',
                'email.unique' => 'This email is already registered.',

             
                'name.string'   => 'The employee name must be a valid string.',
                'name.max'      => 'The employee name cannot exceed 100 characters.',
            
                'employee_id.string' => 'Employee ID must be a valid string.',
                'employee_id.max'    => 'Employee ID cannot exceed 200 characters.',
             
            
                'joining_date.required' => 'The joining date is required.',
                'joining_date.date'     => 'The joining date must be a valid date.',
            
                'user_name.required' => 'The user name is required.',
                'user_name.string'   => 'The user name must be a valid string.',
                'user_name.max'      => 'The user name cannot exceed 100 characters.',
            
                'password.required' => 'The password is required.',
                'password.string'   => 'The password must be a valid string.',
                'password.min'      => 'The password must be at least 1 character long.',
            
                'email_id.required' => 'The email ID is required.',
                'email_id.email'    => 'Please enter a valid email address.',
                'email_id.max'      => 'The email ID cannot exceed 40 characters.',
                'email_id.unique'   => 'This email ID is already registered.',
            
                'phone.required' => 'The phone number is required.',
                'phone.string'   => 'The phone number must be a valid string.',
                'phone.max'      => 'The phone number cannot exceed 30 characters.',
            
                'department.required' => 'The department is required.',
                'department.integer'  => 'The department must be a valid integer.',
                'department.in'       => 'The selected department is invalid.',
            
                'designation.required' => 'The designation is required.',
                'designation.in'       => 'The selected designation is invalid.',
            
                'status.required' => 'The status is required.',
                'status.in'       => 'The selected status is invalid.',
            
                'role.required' => 'The role is required.',
                'role.in'       => 'The selected role is invalid.',
            
                'address.required' => 'The address is required.',
                'address.string'   => 'The address must be a valid string.',
                'address.max'      => 'The address cannot exceed 50 characters.',
            
                'profile_image.image' => 'The profile image must be a valid image file.',
                'profile_image.mimes' => 'The profile image must be of type jpeg, png, or jpg.',
                'profile_image.max'   => 'The profile image cannot exceed 2048KB.',
    
            ]);

            // Create a new User instance (previously Employee)
            $employee = new User();
            $employee->name = $request->name;
            $employee->employee_id = $request->employee_id;
            $employee->joining_date = $request->joining_date;
            $employee->user_name = $request->user_name;

            if ($request->password) {
                $employee->password = bcrypt($request->password);
            }

            $employee->email = $request->email_id;
            $employee->phone = $request->phone;
            $employee->department = $request->department;
            $employee->designation = $request->designation;
            $employee->status = $request->status;
            $employee->role = $request->role;
            $employee->webhook_url = $request->webhook_url;
            $employee->address = $request->address;
            $employee->description = $request->description;
            $employee->created_by = Auth::id();
            $employee->updated_by = Auth::id();

            // Handle Profile Image Upload
            if ($request->hasFile('profile_image')) {
                $fileName = time() . '.' . $request->profile_image->extension();
                $filePath = public_path('images/employee_profiles/');

                if (!file_exists($filePath)) {
                    mkdir($filePath, 0777, true);
                }

                $request->profile_image->move($filePath, $fileName);
                $employee->profile_image = 'images/employee_profiles/' . $fileName;
            }

            $employee->save();

            if ($request->ajax()) {
                return response()->json(['success' => 'Employee added successfully!']);
            }

            return redirect()->route('admin.our-employee.members')
                ->with('success', 'Employee added successfully!');
        }

        
    public function edit($id)
     {
        $employee = User::findOrFail($id); // Fetch the Employee by ID
        return response()->json($employee); // Return Employee data as JSON
     }

    public function update(Request $request, $id)
    {
      
        // Fetch the employee by ID
        $employee = User::findOrFail($id);
    
        // Validation
        $request->validate([
            'name'         => 'required|string|max:100',
            // 'employee_id'  => 'nullable|string|max:200|unique:users,employee_id,' . $id,
            'employee_id'  => 'nullable|string|max:200',
            'joining_date' => 'required|date',
            'user_name'    => 'required|string|max:100',
            'password'     => 'nullable|string|min:1', // Password can be nullable during update
            // 'email_id'     => 'required|email|max:40|unique:users,email_id,' . $id,
            'email_id'     => 'required|email|max:40',
            'phone'        => 'required|string|max:30',
            'department'   => 'required|integer|in:1,2,3,4,5',
            'designation'  => 'required|integer|in:1,2,3,4,5,6,7,8,9,10',
            'status'       => 'required|integer|in:1,2',
            'role'         => 'required|integer|in:1,2,3,4',
            'webhook_url'  => 'nullable|string|max:255',
            'address'      => 'required|string|max:50',
            'description'  => 'nullable|string',
            'profile_image'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'name.required' => 'The employee name is required.',
            'name.string'   => 'The employee name must be a valid string.',
            'name.max'      => 'The employee name cannot exceed 100 characters.',
        
            'employee_id.string' => 'Employee ID must be a valid string.',
            'employee_id.max'    => 'Employee ID cannot exceed 200 characters.',
            'employee_id.unique' => 'This Employee ID is already registered.',
        
            'joining_date.required'=> 'The joining date is required.',
            'joining_date.date'    => 'The joining date must be a valid date.',
        
            'user_name.required' => 'The user name is required.',
            'user_name.string'   => 'The user name must be a valid string.',
            'user_name.max'      => 'The user name cannot exceed 100 characters.',
        
            'password.required' => 'The password is required.',
            'password.string'   => 'The password must be a valid string.',
            'password.min'      => 'The password must be at least 1 character long.',
        
            'email_id.required' => 'The email ID is required.',
            'email_id.email'    => 'Please enter a valid email address.',
            'email_id.max'      => 'The email ID cannot exceed 40 characters.',
            'email_id.unique'   => 'This email ID is already registered.',
        
            'phone.required' => 'The phone number is required.',
            'phone.string'   => 'The phone number must be a valid string.',
            'phone.max'      => 'The phone number cannot exceed 30 characters.',
        
            'department.required' => 'The department is required.',
            'department.integer'  => 'The department must be a valid integer.',
            'department.in'       => 'The selected department is invalid.',
        
            'designation.required' => 'The designation is required.',
            'designation.in'       => 'The selected designation is invalid.',
        
            'status.required' => 'The status is required.',
            'status.in'       => 'The selected status is invalid.',
        
            'role.required' => 'The role is required.',
            'role.in'       => 'The selected role is invalid.', 
        
            'address.required' => 'The address is required.',
            'address.string'   => 'The address must be a valid string.',
            'address.max'      => 'The address cannot exceed 50 characters.',
        
            'profile_image.image' => 'The profile image must be a valid image file.',
            'profile_image.mimes' => 'The profile image must be of type jpeg, png, or jpg.',
            'profile_image.max'   => 'The profile image cannot exceed 2048KB.',
        ]);
    
        // Update Employee Details
        $employee->name = $request->name;
        $employee->employee_id = $request->employee_id;
        $employee->joining_date = $request->joining_date;
        $employee->user_name = $request->user_name;
    
        // If password is provided, hash and update it
        if ($request->password) {
            $employee->password = Hash::make($request->password);
        }
    
        $employee->email = $request->email_id;
        $employee->phone = $request->phone;
        $employee->department = $request->department;
        $employee->designation = $request->designation;
        $employee->status = $request->status;
        $employee->role = $request->role;
        $employee->webhook_url = $request->webhook_url;
        $employee->address = $request->address;
        $employee->description = $request->description;
        $employee->updated_by = Auth::id();
    
        // Handle profile image upload (if exists)
        if ($request->hasFile('profile_image')) {
            $fileName = time() . '.' . $request->profile_image->extension();
            $filePath = public_path('images/employee_profiles/');
    
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
    
            $request->profile_image->move($filePath, $fileName);
            $employee->profile_image = 'images/employee_profiles/' . $fileName;
        }
    
        $employee->save();
        // Save the updated employee data
        if ($request->ajax()) {
            return response()->json(['success' => 'Employee updated successfully!']);
        }
    
     
    }
    

    
    // DELETE SINGLE EMPLOYEE INFORMATION - AUTH - RI - 05-03-2025
    public function destroy($id)
    {
        $employee = User::findOrFail($id); // Find the employee by ID
        $employee->delete(); // Delete the employee

        return response()->json(['success' => true, 'message' => 'Employee deleted successfully.']);
    }



    public function membersProfile(){
        return view('backend.our-employee.members-profile');
    }

    public function holidays(){
        return view('backend.our-employee.holidays');
    }

    public function attendanceEmployee(){
        return view('backend.our-employee.attendance-employee');
    }

    public function attendance(){
        $collection = collect([
        [
            'name' => 'Joan Dyer',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Ryan Randall	',
            'attendance' => [
                'icofont-close-circled text-danger',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-close-circled text-danger',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-close-circled text-danger',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name'=> 'Ryan Randall	',
            'attendance'=> [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Victor Rampling',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Sally Graham',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Robert Anderson',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Ryan Stewart',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                ''
            ]
        ]
    ]);
        $data = $collection->all();
        
        return view('backend.our-employee.attendance',compact('data'));
    }

    public function leaveRequest(){
        return view('backend.our-employee.leave-request');
    }

    public function department(){
        return view('backend.our-employee.department');
    }

    public function payroll(){
        return view('backend.our-employee.payroll');
    }
}
