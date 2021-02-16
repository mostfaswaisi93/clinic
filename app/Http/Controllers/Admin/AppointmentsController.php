<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Validator;

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
            return datatables()->of($appointments)->make(true);
        }
        return view('admin.appointments.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'price'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Appointment::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Appointment::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Appointment $appointment)
    {
        $rules = array(
            'price'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'       =>   $request->name,
            'price'      =>   $request->price,
        );

        $appointment::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        DB::table("appointments")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The data has been deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment           = Appointment::find($id);
        $enabled               = $request->get('enabled');
        $appointment->enabled  = $enabled;
        $appointment           = $appointment->save();

        if ($appointment) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}
