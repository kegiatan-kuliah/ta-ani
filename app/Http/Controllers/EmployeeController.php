<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Validator;
use App\DataTables\EmployeesDataTable;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    private $table;

    public function __construct(Employee $table, User $userTable) {
        $this->table = $table;
        $this->userTable = $userTable;
    }

    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('pages.employee.index');
    }

    public function new()
    {
        return view('pages.employee.new');
    }

    public function edit($id)
    {
        $data = $this->table->findOrFail($id);
        return view('pages.employee.edit')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'min:3',
                Rule::unique('users', 'email')->where(function ($query) use ($request) {
                    return $query->where('role', $request->no);
                }),
            ],
            'identity_no' => 'required|min:3|unique:employees,identity_no',
            'name' => 'required|min:3',
            'gender' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $user = $this->userTable->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(123456789),
            'role' => $request->role,
            'is_active' => true
        ]);

        $store = $this->table->create([
            'name' => $request->name,
            'email' => $request->email,
            'identity_no' => $request->identity_no,
            'gender' => $request->gender,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'user_id' => $user->id
        ]);

        return redirect()->route('employee.index')->with('success', 'Data saved successfully');
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'min:3',
                Rule::unique('users', 'email')->where(function ($query) use ($request) {
                    return $query->where('role', $request->role);
                })->ignore($request->id),
            ],
            'identity_no' => 'required|min:3|unique:employees,identity_no,'.$request->id,
            'name' => 'required|min:3',
            'gender' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $member = $this->table->findOrFail($request->id);

        $this->userTable->where('id', $member->user_id)->update([
            'email' => $request->email,
            'role' => $request->role
        ]);

        $store = $this->table->where('id', $request->id)->update([
            'name' => $request->name,
            'identity_no' => $request->identity_no,
            'gender' => $request->gender,
            'phone_no' => $request->phone_no,
            'address' => $request->address
        ]);

        return redirect()->route('employee.index')->with('success', 'Data updated successfully');
    }

    public function destroy($id) {
        $member = $this->table->findOrFail($id);
        $data = $this->table->findOrFail($id);

        $this->userTable->where('id', $member->user_id)->delete();

        $destroy = $data->delete();

        return redirect()->route('employee.index')->with('success', 'Data deleted successfully');
    }
}
