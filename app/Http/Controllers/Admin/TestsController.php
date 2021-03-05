<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Validator;

class TestsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_tests'])->only('index');
        $this->middleware(['permission:create_tests'])->only('create');
        $this->middleware(['permission:update_tests'])->only('edit');
        $this->middleware(['permission:delete_tests'])->only('destroy');
    }

    public function index()
    {
        $tests = Test::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $tests->where('enabled', $enabled)->get();
            $tests = $tests->get();
            return datatables()->of($tests)->make(true);
        }
        return view('admin.tests.index');
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

        Test::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Test::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Test $test)
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
            'name'          =>   json_encode($request->name, JSON_UNESCAPED_UNICODE),
            'description'   =>   $request->description
        );

        $test::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Test::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The data has been deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $test           = Test::find($id);
        $enabled        = $request->get('enabled');
        $test->enabled  = $enabled;
        $test           = $test->save();

        if ($test) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}
