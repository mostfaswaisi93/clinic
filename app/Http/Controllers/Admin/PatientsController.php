<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

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
        $patients = Patient::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $patients->where('enabled', $enabled)->get();
            $patients = $patients->get();
            return datatables()->of($patients)
            ->addColumn('user', function ($data) {
                return $data->user->full_name_trans;
            })->make(true);
        }
        return view('admin.patients.index')
        ->with('users', User::get(['id', 'username']));;
    }

    public function store(Request $request)
    {
        $rules = array(
            'address'    =>  'required',
            'phone'    =>  'required',
            'dob'    =>  'required',
            'notes'    =>  'required',
            'user_id'    =>  'required',
            'constant_id'    =>  'required',
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['full_name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'full_name'       =>   $request->full_name
        );

        Patient::create($request_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Patient::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Patient $patient)
    {
        $rules = array(
            'address'    =>  'required',
            'phone'    =>  'required',
            'dob'    =>  'required',
            'notes'    =>  'required',
            'constant_id'    =>  'required',
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['full_name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'full_name'       =>   json_encode($request->full_name, JSON_UNESCAPED_UNICODE),
        );

        $patient::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Patient::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $patient           = Patient::find($id);
        $enabled           = $request->get('enabled');
        $patient->enabled  = $enabled;
        $patient           = $patient->save();

        if ($patient) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated.']);
        }
    }
}
