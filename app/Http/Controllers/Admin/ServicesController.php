<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_services'])->only('index');
        $this->middleware(['permission:create_services'])->only('create');
        $this->middleware(['permission:update_services'])->only('edit');
        $this->middleware(['permission:delete_services'])->only('destroy');
    }

    public function index()
    {
        $services = Service::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($services)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_services', 'delete_services'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="services/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i data-feather="trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.services.index');
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(ServicesRequest $request)
    {
        $rules = [
            'price'     => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        Service::create($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServicesRequest $request, Service $service)
    {
        $rules = [
            'price'     => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        $service->update($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.services.index');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $service           = Service::find($id);
        $enabled           = $request->get('enabled');
        $service->enabled  = $enabled;
        $service           = $service->save();

        if ($service) {
            return response(['success' => TRUE, "message" => 'Done']);
        }
    }
}
