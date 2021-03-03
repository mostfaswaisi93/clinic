<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_invoices'])->only('index');
        $this->middleware(['permission:create_invoices'])->only('create');
        $this->middleware(['permission:update_invoices'])->only('edit');
        $this->middleware(['permission:delete_invoices'])->only('destroy');
    }

    public function index()
    {
        $invoices = Invoice::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($invoices)->make(true);
        }
        return view('admin.invoices.index');
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

        Invoice::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Invoice::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Invoice $invoice)
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
            'price'      =>   $request->price,
        );

        $invoice::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $invoice           = Invoice::find($id);
        $enabled           = $request->get('enabled');
        $invoice->enabled  = $enabled;
        $invoice           = $invoice->save();

        if ($invoice) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}
