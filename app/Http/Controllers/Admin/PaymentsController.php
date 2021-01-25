<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_payments'])->only('index');
        $this->middleware(['permission:create_payments'])->only('create');
        $this->middleware(['permission:update_payments'])->only('edit');
        $this->middleware(['permission:delete_payments'])->only('destroy');
    }

    public function index()
    {
        $payments = Department::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($payments)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_payments', 'delete_payments'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="payments/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.payments.index');
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(PaymentsRequest $request)
    {
        Role::create([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.added_successfully'));
        return redirect()->route('admin.payments.index');
    }

    public function edit(Role $role)
    {
        return view('admin.payments.edit')->with('role', $role);
    }

    public function update(PaymentsRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.updated_successfully'));
        return redirect()->route('admin.payments.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
