<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Validator;

class ReceiptsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_receipts'])->only('index');
        $this->middleware(['permission:create_receipts'])->only('create');
        $this->middleware(['permission:update_receipts'])->only('edit');
        $this->middleware(['permission:delete_receipts'])->only('destroy');
    }

    public function index()
    {
        $receipts = Receipt::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $receipts->where('enabled', $enabled)->get();
            $receipts = $receipts->get();
            return datatables()->of($receipts)->make(true);
        }
        return view('admin.receipts.index');
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

        $request_data = array(
            'name'       =>   $request->name,
            'price'      =>   $request->price
        );

        Receipt::create($request_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Receipt::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Receipt $receipt)
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
            'name'       =>   json_encode($request->name, JSON_UNESCAPED_UNICODE),
            'price'      =>   $request->price
        );

        $receipt::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
    }

    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Receipt::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $receipt           = Receipt::find($id);
        $enabled           = $request->get('enabled');
        $receipt->enabled  = $enabled;
        $receipt           = $receipt->save();

        if ($receipt) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated.']);
        }
    }
}
