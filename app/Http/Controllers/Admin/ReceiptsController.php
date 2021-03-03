<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptsRequest;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

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

    public function create()
    {
        return view('admin.receipts.create');
    }

    public function store(ReceiptsRequest $request)
    {
        Receipt::create([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.receipts.index');
    }

    public function edit(Receipt $receipt)
    {
        return view('admin.receipts.edit')->with('receipt', $receipt);
    }

    public function update(ReceiptsRequest $request, Receipt $receipt)
    {
        $receipt->update([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.receipts.index');
    }

    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->delete();
    }
}
