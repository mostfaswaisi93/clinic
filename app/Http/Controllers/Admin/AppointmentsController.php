<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentsRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class AppointmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_appointments'])->only('index');
        $this->middleware(['permission:create_appointments'])->only('create');
        $this->middleware(['permission:update_appointments'])->only('edit');
        $this->middleware(['permission:delete_appointments'])->only('destroy');
    }

    public function index()
    {
        $appointments = Appointment::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($appointments)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_appointments', 'delete_appointments'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="appointments/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.appointments.index');
    }

    public function create()
    {
        return view('admin.appointments.create');
    }

    public function store(AppointmentsRequest $request)
    {
        Appointment::create([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit')->with('appointment', $appointment);
    }

    public function update(AppointmentsRequest $request, Appointment $appointment)
    {
        $appointment->update([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.appointments.index');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
    }
}
