<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Validator;

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
        $payments = Service::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $payments->where('enabled', $enabled)->get();
            $payments = $payments->get();
            return datatables()->of($payments)->make(true);
        }
        return view('admin.payments.index');
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

        Service::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Service::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Service $service)
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
            'name'       =>   json_encode($request->name, JSON_UNESCAPED_UNICODE),
            'price'      =>   $request->price,
        );

        $service::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Service::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $service           = Service::find($id);
        $enabled           = $request->get('enabled');
        $service->enabled  = $enabled;
        $service           = $service->save();

        if ($service) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated.']);
        }
    }
}
