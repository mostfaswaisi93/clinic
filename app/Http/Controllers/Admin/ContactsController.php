<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::with(['customer'])->get();

        if (request()->ajax()) {
            return datatables()->of($contacts)
                ->addColumn('customer', function ($data) {
                    return $data->customer->first_name;
                })
                ->addColumn('action', function ($data) {
                    if (auth()->user()->hasPermission('read_contacts')) {
                        $button = '<a type="button" title="Show" name="show" href="contacts/' . $data->id . '" class="show btn btn-sm btn-icon"><i class="fa fa-folder-open"></i></a>';
                    } else {
                        $button = '<a type="button" title="Show" name="show" id="' . $data->id . '" class="show btn btn-sm btn-icon disabled"><i class="fa fa-folder-open"></i></a>';
                    }
                    $button .= '&nbsp;&nbsp;';
                    if (auth()->user()->hasPermission('delete_contacts')) {
                        $button .= '<a type="button" title="Delete" name="delete" id="' . $data->id . '" class="delete btn btn-sm btn-icon"><i class="fa fa-trash"></i></a>';
                    } else {
                        $button .= '<a type="button" title="Delete" name="delete" id="' . $data->id . '" class="delete btn btn-sm btn-icon disabled"><i class="fa fa-trash"></i></a>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.contacts.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'iso_code'      => 'required|max:3|unique:contacts',
            'phone_code'    => 'required|unique:contacts'
        ];

        $request->validate($rules);

        Contact::create($request->all());
        Toastr::success(__('admin.added_successfully'));
        return redirect()->route('admin.contacts.index');
    }

    public function show(Contact $contact)
    {
        $contacts = Contact::get();
        $contact->update(['readable' => 1]);
        return view('admin.contacts.show', compact('contacts', 'contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
    }
}
