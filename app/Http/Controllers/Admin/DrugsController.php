<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\Request;
use Validator;

class DrugsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_drugs'])->only('index');
        $this->middleware(['permission:create_drugs'])->only('create');
        $this->middleware(['permission:update_drugs'])->only('edit');
        $this->middleware(['permission:delete_drugs'])->only('destroy');
    }

    public function index()
    {
        $drugs = Drug::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($drugs)->make(true);
        }
        return view('admin.drugs.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'description'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Drug::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Drug::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Drug $drug)
    {
        $rules = array(
            'description'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'          =>   $request->name,
            'description'   =>   $request->description,
        );

        $drug::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $drug = Drug::findOrFail($id);
        $drug->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Drug::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The data has been deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $drug           = Drug::find($id);
        $enabled        = $request->get('enabled');
        $drug->enabled  = $enabled;
        $drug           = $drug->save();

        if ($drug) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}