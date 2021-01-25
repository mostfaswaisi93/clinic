<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_sliders'])->only('index');
        $this->middleware(['permission:create_sliders'])->only('create');
        $this->middleware(['permission:update_sliders'])->only('edit');
        $this->middleware(['permission:delete_sliders'])->only('destroy');
    }

    public function index()
    {
        $sliders = Slider::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($sliders)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_sliders', 'delete_sliders'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="sliders/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="feather icon-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="feather icon-trash-2"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.sliders.index');
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(SlidersRequest $request)
    {
        Slider::create([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.added_successfully'));
        return redirect()->route('admin.sliders.index');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit')->with('slider', $slider);
    }

    public function update(SlidersRequest $request, Slider $slider)
    {
        $slider->update([
            'name' => $request->name
        ]);
        Toastr::success(__('admin.updated_successfully'));
        return redirect()->route('admin.sliders.index');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
    }
}
