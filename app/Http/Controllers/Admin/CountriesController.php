<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Validator;

class CountriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_countries'])->only('index');
        $this->middleware(['permission:create_countries'])->only('create');
        $this->middleware(['permission:update_countries'])->only('edit');
        $this->middleware(['permission:delete_countries'])->only('destroy');
    }

    public function index()
    {
        $countries = Country::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $countries->where('enabled', $enabled)->get();
            $countries = $countries->get();
            return datatables()->of($countries)->make(true);
        }
        return view('admin.countries.index');
    }

    public function store(Request $request)
    {
        $rules = array();

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Country::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Country::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Country $country)
    {
        $rules = array();

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'       =>   json_encode($request->name, JSON_UNESCAPED_UNICODE),
        );

        $country::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Country::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The data has been deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $country           = Country::find($id);
        $enabled           = $request->get('enabled');
        $country->enabled  = $enabled;
        $country           = $country->save();

        if ($country) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}
