<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountriesRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

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
        $countries = Country::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($countries)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_countries', 'delete_countries'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="countries/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.countries.index');
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(CountriesRequest $request)
    {
        $rules = [
            'mob'       => 'required',
            'code'      => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
            $rules += ['currency.' . $locale => 'required'];
        }

        $request->validate($rules);

        Country::create($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.countries.index');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(CountriesRequest $request, Country $country)
    {
        $rules = [
            'mob'       => 'required',
            'code'      => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
            $rules += ['currency.' . $locale => 'required'];
        }

        $request->validate($rules);

        $country->update($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.countries.index');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $country           = Country::find($id);
        $enabled           = $request->get('enabled');
        $country->enabled  = $enabled;
        $country           = $country->save();

        if ($country) {
            return response(['success' => TRUE, "message" => 'Done']);
        }
    }
}
