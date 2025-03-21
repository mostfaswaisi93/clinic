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
        $drugs = Drug::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $drugs->where('enabled', $enabled)->get();
            $drugs = $drugs->get();
            return datatables()->of($drugs)->make(true);
        }
        return view('admin.drugs.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'trade_name'      =>  'required',
            'generic_name'    =>  'required',
            'notes'           =>  'required'
        );

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
            'trade_name'      =>  'required',
            'generic_name'    =>  'required',
            'notes'           =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'trade_name'     =>   $request->trade_name,
            'generic_name'   =>   $request->generic_name,
            'notes'          =>   $request->notes
        );

        $drug::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
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
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $drug           = Drug::find($id);
        $enabled        = $request->get('enabled');
        $drug->enabled  = $enabled;
        $drug           = $drug->save();

        if ($drug) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated.']);
        }
    }
}
