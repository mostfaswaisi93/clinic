<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_services'])->only('index');
        $this->middleware(['permission:create_services'])->only('create');
        $this->middleware(['permission:update_services'])->only('edit');
        $this->middleware(['permission:delete_services'])->only('destroy');
    }

    public function index()
    {
        $services = Department::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($services)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_services', 'delete_services'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="services/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.services.index');
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(ServicesRequest $request)
    {
        Role::create([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.added_successfully'));
        return redirect()->route('admin.services.index');
    }

    public function edit(Role $role)
    {
        return view('admin.services.edit')->with('role', $role);
    }

    public function update(ServicesRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.updated_successfully'));
        return redirect()->route('admin.services.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
