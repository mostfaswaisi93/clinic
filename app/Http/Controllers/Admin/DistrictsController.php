<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

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
        $districts = District::OrderBy('created_at', 'desc')->with(['city', 'country'])->get();
        if (request()->ajax()) {
            return datatables()->of($districts)
                ->addColumn('city', function ($data) {
                    return $data->city->name_trans;
                })
                ->addColumn('country', function ($data) {
                    return $data->country->name_trans;
                })
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_districts', 'delete_districts'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="districts/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i data-feather="trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.districts.index');
    }

    public function create()
    {
        $cities = City::active()->get();
        $countries = Country::active()->get();
        return view('admin.districts.create', compact('cities', 'countries'));
    }

    public function store(districtsRequest $request)
    {
        $rules = [
            'city_id'       => 'required',
            'country_id'    => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        District::create($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.districts.index');
    }

    public function edit(district $district)
    {
        $cities = City::active()->get();
        $countries = Country::active()->get();
        return view('admin.districts.edit', compact('cities', 'countries', 'district'));
    }

    public function update(districtsRequest $request, district $district)
    {
        $rules = [
            'city_id'       => 'required',
            'country_id'    => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        $district->update($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.districts.index');
    }

    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $district           = District::find($id);
        $enabled         = $request->get('enabled');
        $district->enabled  = $enabled;
        $district           = $district->save();

        if ($district) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}