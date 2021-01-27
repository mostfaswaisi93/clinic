<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientsRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class PatientsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_patients'])->only('index');
        $this->middleware(['permission:create_patients'])->only('create');
        $this->middleware(['permission:update_patients'])->only('edit');
        $this->middleware(['permission:delete_patients'])->only('destroy');
    }

    public function index()
    {
        $patients = Patient::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($patients)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_patients', 'delete_patients'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="patients/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i data-feather="trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.patients.index');
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(PatientsRequest $request)
    {
        Patient::create([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit')->with('patient', $patient);
    }

    public function update(PatientsRequest $request, Patient $patient)
    {
        $patient->update([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.patients.index');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
    }
}
