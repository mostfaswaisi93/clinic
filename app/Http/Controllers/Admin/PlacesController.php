<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PlacesController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $locations = Location::with(['country', 'city', 'state'])->paginate(5);
        return view('frontend.index', compact('countries', 'locations'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $location = Location::create([
            'title'         => Str::random(10),
            'country_id'    => $request->country_id,
            'city_id'       => $request->city_id,
            'state_id'      => $request->state_id,
        ]);

        if ($location) {
            return redirect()->back()->with([
                'message' => 'Place added successfully',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger'
            ]);
        }
    }

    public function get_cities(Request $request)
    {
        $cities = City::whereCountryId($request->country_id)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function get_states(Request $request)
    {
        $states = State::whereCityId($request->city_id)->pluck('name', 'id');
        return response()->json($states);
    }
}
