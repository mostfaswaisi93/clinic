<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionsRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

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

    public function create()
    {
        return view('admin.transactions.create');
    }

    public function store(TransactionsRequest $request)
    {
        Transaction::create([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        return view('admin.transactions.edit')->with('transaction', $transaction);
    }

    public function update(TransactionsRequest $request, Transaction $transaction)
    {
        $transaction->update([
            'name' => $request->name
        ]);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.transactions.index');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
    }
}
