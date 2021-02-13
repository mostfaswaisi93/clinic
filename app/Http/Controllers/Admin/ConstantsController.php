<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use Illuminate\Http\Request;

class ConstantsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_constants'])->only('index');
        $this->middleware(['permission:create_constants'])->only('create');
        $this->middleware(['permission:update_constants'])->only('edit');
        $this->middleware(['permission:delete_constants'])->only('destroy');
    }

    public function index()
    {
        $constants = Constant::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($constants)->make(true);
        }
        return view('admin.constants.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'price'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Constant::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Constant::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Constant $constant)
    {
        $rules = array(
            'price'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'       =>   $request->name,
            'price'      =>   $request->price,
        );

        $constant::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $constant = Constant::findOrFail($id);
        $constant->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $constant           = Constant::find($id);
        $enabled            = $request->get('enabled');
        $constant->enabled  = $enabled;
        $constant           = $constant->save();

        if ($constant) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}