<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_invoices'])->only('index');
        $this->middleware(['permission:create_invoices'])->only('create');
        $this->middleware(['permission:update_invoices'])->only('edit');
        $this->middleware(['permission:delete_invoices'])->only('destroy');
    }

    public function index()
    {
        $invoices = Department::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($invoices)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_invoices', 'delete_invoices'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="invoices/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.invoices.index');
    }

    public function create()
    {
        return view('admin.invoices.create');
    }

    public function store(InvoicesRequest $request)
    {
        Role::create([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.added_successfully'));
        return redirect()->route('admin.invoices.index');
    }

    public function edit(Role $role)
    {
        return view('admin.invoices.edit')->with('role', $role);
    }

    public function update(InvoicesRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.updated_successfully'));
        return redirect()->route('admin.invoices.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
