<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatesRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_states'])->only('index');
        $this->middleware(['permission:create_states'])->only('create');
        $this->middleware(['permission:update_states'])->only('edit');
        $this->middleware(['permission:delete_states'])->only('destroy');
    }

    public function index()
    {
        $states = State::OrderBy('created_at', 'desc')->with(['city', 'country'])->get();
        if (request()->ajax()) {
            return datatables()->of($states)
                ->addColumn('city', function ($data) {
                    return $data->city->name_trans;
                })
                ->addColumn('country', function ($data) {
                    return $data->country->name_trans;
                })
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_states', 'delete_states'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="states/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.states.index');
    }

    public function create()
    {
        $cities = City::active()->get();
        $countries = Country::active()->get();
        return view('admin.states.create', compact('cities', 'countries'));
    }

    public function store(StatesRequest $request)
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

        return redirect()->route('admin.states.index');
    }

    public function edit(State $state)
    {
        $cities = City::active()->get();
        $countries = Country::active()->get();
        return view('admin.states.edit', compact('cities', 'countries', 'state'));
    }

    public function update(StatesRequest $request, State $state)
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

        return redirect()->route('admin.states.index');
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
            return response(['success' => TRUE, "message" => 'Done']);
        }
    }
}
