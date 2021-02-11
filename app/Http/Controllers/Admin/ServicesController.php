<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Validator;

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
        $services = Service::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($services)->make(true);
        }
        return view('admin.services.index');
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
            'name'       =>   $request->name,
            'price'      =>   $request->price,
        );

        $service::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
    }

    public function delete_all(Request $request)
    {
        $ids = explode(",", $request->ids);
        Service::whereIn('id', $ids)->delete();
        return redirect()->route('services.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $service           = Service::find($id);
        $enabled           = $request->get('enabled');
        $service->enabled  = $enabled;
        $service           = $service->save();

        if ($service) {
            return response(['success' => TRUE, "message" => 'Done']);
        }
    }
}
