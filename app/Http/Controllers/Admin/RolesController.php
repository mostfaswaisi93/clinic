<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Models\Role as AppRole;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Validator;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_roles'])->only('index');
        $this->middleware(['permission:create_roles'])->only('create');
        $this->middleware(['permission:update_roles'])->only('edit');
        $this->middleware(['permission:delete_roles'])->only('destroy');
    }

    public function index()
    {
        $roles = AppRole::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($roles)->make(true);
        }
        return view('admin.roles.index');
    }

    public function store(RolesRequest $request)
    {
        $rules = array(
            'name'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Role::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Role::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(RolesRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.roles.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $role           = Role::find($id);
        $enabled        = $request->get('enabled');
        $role->enabled  = $enabled;
        $role           = $role->save();

        if ($role) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}
