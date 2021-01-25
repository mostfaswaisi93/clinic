<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ShippingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_shippings'])->only('index');
        $this->middleware(['permission:create_shippings'])->only('create');
        $this->middleware(['permission:update_shippings'])->only('edit');
        $this->middleware(['permission:delete_shippings'])->only('destroy');
    }

    public function index()
    {
        $shippings = Shipping::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($shippings)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_shippings', 'delete_shippings'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="shippings/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.shippings.index');
    }

    public function create()
    {
        return view('admin.shippings.create');
    }

    public function store(ShippingsRequest $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        Shipping::create($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.shippings.index');
    }

    public function edit(Shipping $shipping)
    {
        return view('admin.shippings.edit')->with('shipping', $shipping);
    }

    public function update(ShippingsRequest $request, Shipping $shipping)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);

        $shipping->update($request->all());

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.shippings.index');
    }

    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        $shipping->delete();
    }
}
