<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Validator;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_notifications'])->only('index');
        $this->middleware(['permission:create_notifications'])->only('create');
        $this->middleware(['permission:update_notifications'])->only('edit');
        $this->middleware(['permission:delete_notifications'])->only('destroy');
    }

    public function index()
    {
        $notifications = Notification::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($notifications)->make(true);
        }
        return view('admin.notifications.index');
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

        Notification::create($request->all());

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Notification::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Notification $notification)
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

        $notification::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $notification           = Notification::find($id);
        $enabled                = $request->get('enabled');
        $notification->enabled  = $enabled;
        $notification           = $notification->save();

        if ($notification) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated']);
        }
    }
}

