<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_transactions'])->only('index');
        $this->middleware(['permission:create_transactions'])->only('create');
        $this->middleware(['permission:update_transactions'])->only('edit');
        $this->middleware(['permission:delete_transactions'])->only('destroy');
    }

    public function index()
    {
        $transactions = Transaction::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $transactions->where('enabled', $enabled)->get();
            $transactions = $transactions->get();
            return datatables()->of($transactions)->make(true);
        }
        return view('admin.transactions.index');
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

        Transaction::create($request_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Transaction::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Transaction $transaction)
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

        $transaction::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Transaction::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction           = Transaction::find($id);
        $enabled               = $request->get('enabled');
        $transaction->enabled  = $enabled;
        $transaction           = $transaction->save();

        if ($transaction) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated.']);
        }
    }
}
