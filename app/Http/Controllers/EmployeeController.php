<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    //list employees
    public function index()
    {
        // Paginate employees (10 per page in this case)
        $employees = Employee::paginate(10);

        return view('employeeView', compact('employees'));
    }

    //Create employees form
    public function create()
    {
        return view('employeeAdd'); // Adjust 'employeeAdd' to your form view file name
    }


    //store employees
    public function store(Request $request)
    {
        // testing
        // dd($request->all());
        // print_r($request->all());
        // exit;

        // Validate form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        

        // Create a new employee record
        $employee = new Employee();
        $employee->first_name = $validatedData['first_name'];
        $employee->last_name = $validatedData['last_name'];
        $employee->email = $validatedData['email'];
        $employee->password = Hash::make($validatedData['password']); // Hash the password

        $employee->save(); // Save the employee to the database
        session()->flash('success', 'Employee has been successfully added!');

        return redirect()->back()->with('success', 'Employee created successfully!');
    }

    // show specific employee
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employeeInfo', compact('employee'));
    }


    // Update employee
    public function edit($id)
    {
        // Find the employee by ID
        $employee = Employee::findOrFail($id);
    
        // Return the edit view with employee data
        return view('employeeUpdate', compact('employee'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id, // Ignore current email in unique check
        ]);
    
        // Find the employee and update details
        $employee = Employee::findOrFail($id);
        $employee->first_name = $validatedData['first_name'];
        $employee->last_name = $validatedData['last_name'];
        $employee->email = $validatedData['email'];
        $employee->save();
    
        // Redirect with success message
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    // delete user
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }


}
