<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class LocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_locations'])->only('index');
        $this->middleware(['permission:create_locations'])->only('create');
        $this->middleware(['permission:update_locations'])->only('edit');
        $this->middleware(['permission:delete_locations'])->only('destroy');
    }

    public function index()
    {
        $locations = Location::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $locations->where('enabled', $enabled)->get();
            $locations = $locations->get();
            return datatables()->of($locations)
                ->addColumn('country', function ($data) {
                    return $data->country->name_trans;
                })
                ->addColumn('city', function ($data) {
                    return $data->city->name_trans;
                })
                ->addColumn('district', function ($data) {
                    return $data->district->name_trans;
                })->make(true);
        }
        return view('admin.locations.index')
            ->with('countries', Country::get(['id', 'name']));
    }

    public function store(Request $request)
    {
        $rules = array(
            'country_id'    =>  'required',
            'city_id'       =>  'required',
            'district_id'   =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['title.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Location::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Location::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Location $location)
    {
        $rules = array(
            'country_id'    =>  'required',
            'city_id'       =>  'required',
            'district_id'   =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['title.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'title'         =>   $request->title,
            'country_id'    =>   $request->country_id,
            'city_id'       =>   $request->city_id,
            'district_id'   =>   $request->district_id
        );

        $location::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function get_cities(Request $request)
    {
        $cities = DB::table("cities")
            ->where("country_id", $request->country_id)
            ->pluck("name", "id");

        return response()->json($cities);
    }

    public function get_districts(Request $request)
    {
        $districts = District::where('city_id', $request->city_id)->get()->pluck('name', 'id');
        return response()->json($districts);
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Location::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The data has been deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $location           = Location::find($id);
        $enabled            = $request->get('enabled');
        $location->enabled  = $enabled;
        $location           = $location->save();

        if ($location) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}
