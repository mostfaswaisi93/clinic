<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

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
        $locations = State::OrderBy('created_at', 'desc')->with(['city', 'country'])->get();
        if (request()->ajax()) {
            return datatables()->of($locations)
                ->addColumn('city', function ($data) {
                    return $data->city->name_trans;
                })
                ->addColumn('country', function ($data) {
                    return $data->country->name_trans;
                })
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_locations', 'delete_locations'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="locations/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i data-feather="trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.locations.index');
    }

    public function create()
    {
        $cities = City::active()->get();
        $countries = Country::active()->get();
        return view('admin.locations.create', compact('cities', 'countries'));
    }

    public function store(locationsRequest $request)
    {
        $rules = [
            'city_id'       => 'required',
            'country_id'    => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        State::create($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.locations.index');
    }

    public function edit(State $state)
    {
        $cities = City::active()->get();
        $countries = Country::active()->get();
        return view('admin.locations.edit', compact('cities', 'countries', 'state'));
    }

    public function update(locationsRequest $request, State $state)
    {
        $rules = [
            'city_id'       => 'required',
            'country_id'    => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        $state->update($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.locations.index');
    }

    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $state           = State::find($id);
        $enabled         = $request->get('enabled');
        $state->enabled  = $enabled;
        $state           = $state->save();

        if ($state) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}