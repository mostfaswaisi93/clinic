<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_notifications'])->only('index');
        $this->middleware(['permission:create_notifications'])->only('create');
        $this->middleware(['permission:update_notifications'])->only('edit');
        $this->middleware(['permission:delete_notifications'])->only('destroy');
    }

    public function index()
    {
        $notifications = Department::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($notifications)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_notifications', 'delete_notifications'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="notifications/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.notifications.index');
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(NotificationsRequest $request)
    {
        Role::create([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.added_successfully'));
        return redirect()->route('admin.notifications.index');
    }

    public function edit(Role $role)
    {
        return view('admin.notifications.edit')->with('role', $role);
    }

    public function update(NotificationsRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.updated_successfully'));
        return redirect()->route('admin.notifications.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
