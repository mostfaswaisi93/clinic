<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Validator;

class CitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_cities'])->only('index');
        $this->middleware(['permission:create_cities'])->only('create');
        $this->middleware(['permission:update_cities'])->only('edit');
        $this->middleware(['permission:delete_cities'])->only('destroy');
    }

    public function index()
    {
        $cities = City::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $cities->where('enabled', $enabled)->get();
            $cities = $cities->get();
            return datatables()->of($cities)
                ->addColumn('country', function ($data) {
                    return $data->country->name_trans;
                })->make(true);
        }
        return view('admin.cities.index')
            ->with('countries', Country::get(['id', 'name']));
    }

    public function store(Request $request)
    {
        $rules = array(
            'country_id'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        City::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = City::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, City $city)
    {
        $rules = array(
            'country_id'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'          =>   $request->name,
            'country_id'    =>   $request->country_id,
        );

        $city::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        City::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The data has been deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $city           = City::find($id);
        $enabled        = $request->get('enabled');
        $city->enabled  = $enabled;
        $city           = $city->save();

        if ($city) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}
