<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class DistrictsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_districts'])->only('index');
        $this->middleware(['permission:create_districts'])->only('create');
        $this->middleware(['permission:update_districts'])->only('edit');
        $this->middleware(['permission:delete_districts'])->only('destroy');
    }

    public function index()
    {
        $districts = District::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($districts)
                ->addColumn('country', function ($data) {
                    return $data->country->name_trans;
                })
                ->addColumn('city', function ($data) {
                    return $data->city->name_trans;
                })->make(true);
        }
        return view('admin.districts.index')
            ->with('countries', Country::get(['id', 'name']))
            ->with('cities', City::get(['id', 'name']));
    }

    public function store(Request $request)
    {
        $rules = array(
            'country_id'    =>  'required',
            'city_id'       =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        District::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = District::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, District $district)
    {
        $rules = array(
            'country_id'    =>  'required',
            'city_id'       =>  'required'
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
            'city_id'       =>   $request->city_id
        );

        $district::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        DB::table("districts")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The data has been deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $district           = District::find($id);
        $enabled            = $request->get('enabled');
        $district->enabled  = $enabled;
        $district           = $district->save();

        if ($district) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}
