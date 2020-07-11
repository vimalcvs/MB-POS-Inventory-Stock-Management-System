<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\EmployeeRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Toastr;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_employee')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')){
            $employees =  Employee::orderBy('id', 'DESC')->get();
        }else{
            $employees =  Employee::where('branch_id', auth()->user()->employee->branch_id)->get();
        }

        return view('backend.employee.index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_employee')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.employee.create', [
            'departments' => Department::orderBy('title', 'asc')->get(),
            'designations' => Designation::orderBy('title', 'asc')->get(),
            'branches' => Branch::orderBy('title', 'asc')->get(),
            'roles' => Role::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        if (!Auth::user()->can('manage_employee')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->get('password'));
        $user->assignRole($request->role);
        $user->save();

        $employee = new Employee();
        $employee->fill($request->all());
        $employee->user_id = $user->id;
        if($request->hasFile('profile_picture')){
            $employee->profile_picture = $request->profile_picture->move('uploads/user/', str_random(20) . '.' . $request->profile_picture->extension());;
        }
        $employee->save();

        Toastr::success('Employee Successfully Created', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect(route('employee.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')){
            if ($employee->branch_id  = auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }

        if (DB::table('model_has_roles')->where('model_id', $employee->user_id)->count() > 0) {
            $selected_role = DB::table('model_has_roles')->where('model_id', $employee->user_id)->first();
            $role = Role::findOrFail($selected_role->role_id)->name;
        } else {
            $role = '--';
        }

        return view('backend.employee.show', [
            'role' => $role,
            'employee' => Employee::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('manage_employee')) {
            return redirect('home')->with(denied());
        } // end permission checking

       $employee = Employee::findOrFail($id);

        if (!Auth::user()->can('access_to_all_branch')){
            if ($employee->branch_id  = auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }


        if (DB::table('model_has_roles')->where('model_id', $employee->user_id)->count() > 0) {
            $selected_role = DB::table('model_has_roles')->where('model_id', $employee->user_id)->first();
            $selected_role_id = $selected_role->role_id;
        } else {
            $selected_role_id = 0;
        }


        return view('backend.employee.edit', [
            'departments' => Department::orderBy('title', 'asc')->get(),
            'designations' => Designation::orderBy('title', 'asc')->get(),
            'branches' => Branch::orderBy('title', 'asc')->get(),
            'roles' => Role::get(),
            'selected_role_id' => $selected_role_id,
            'employee' => Employee::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {



       if (!Auth::user()->can('manage_employee')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $employee = Employee::findOrFail($id);

        if (!Auth::user()->can('access_to_all_branch')){
            if ($employee->branch_id  = auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }


        $employee->fill($request->all());
        if($request->hasFile('profile_picture')){
            $employee->profile_picture = $request->profile_picture->move('uploads/employee/', str_random(40) . '.' . $request->profile_picture->extension());;
        }
        $employee->save();

        $user = User::findOrFail($employee->user_id);
        $user->fill($request->all());
        if ($request->password != ''){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->role);

        Toastr::success('Employee Successfully Updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect(route('employee.index'));
    }

    public function changeStatus($user_id)
    {
        if (!Auth::user()->can('manage_employee')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $user = User::findOrFail($user_id);
        $user->active_status = $user->active_status == 1 ? 0 : 1;
        $user->save();

        $employee  = $user->employee;
        $employee->status = $user->active_status;
        Toastr::success('Status successfully changed', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        Toastr::success('Employee Successfully deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }
}
