<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CitiesRequest;
use App\Models\City;
use App\Models\Country;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

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
        $cities = City::OrderBy('created_at', 'desc')->with(['country'])->get();
        if (request()->ajax()) {
            return datatables()->of($cities)
                ->addColumn('country', function ($data) {
                    return $data->country->name_trans;
                })
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_cities', 'delete_cities'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="cities/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.cities.index');
    }

    public function create()
    {
        $countries = Country::active()->get();
        return view('admin.cities.create')->with('countries', $countries);
    }

    public function store(CitiesRequest $request)
    {
        $rules = [
            'country_id'   => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        City::create($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.cities.index');
    }

    public function edit(City $city)
    {
        $countries = Country::active()->get();
        return view('admin.cities.edit', compact('countries', 'city'));
    }

    public function update(CitiesRequest $request, City $city)
    {
        $rules = [
            'country_id'   => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        $city->update($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.cities.index');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $city           = City::find($id);
        $enabled        = $request->get('enabled');
        $city->enabled  = $enabled;
        $city           = $city->save();

        if ($city) {
            return response(['success' => TRUE, "message" => 'Done']);
        }
    }
}
