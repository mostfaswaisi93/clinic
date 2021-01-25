<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index()
    {
        // $users = User::OrderBy('created_at', 'desc')->role('admin')->get();
        $users = User::OrderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($users)
                ->addColumn('action', function ($data) {
                    if (auth()->user()->can(['update_users', 'delete_users'])) {
                        $button = '<a type="button" title="' . trans("admin.edit") . '" name="edit" href="users/' . $data->id . '/edit" class="edit btn btn-sm btn-icon"><i class="fa fa-edit"></i></a>';
                        $button .= '&nbsp;';
                        $button .= '<a type="button" title="' . trans("admin.delete") . '" name="delete" id="' . $data->id . '"  class="delete btn btn-sm btn-icon"><i class="fa fa-trash"></i></a>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UsersRequest $request)
    {
        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('images/users/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $user = User::create($request_data);
        $user->assignRole('admin');
        $user->syncPermissions($request->permissions);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'image' => 'image',
            'permissions' => 'required|min:1',
        ]);

        $request_data = $request->except(['permissions', 'image']);
        if ($request->image) {
            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/users/' . $user->image);
            }

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('images/users/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/users/' . $user->image);
        }
        $user->delete();
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            User::destroy(request('item'));
        } else {
            $user = User::find(request('item'));
            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/users/' . $user->image);
            }
            $user->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('users'));
    }

    function multi(Request $request)
    {
        $users = $request->input('id');
        $user = User::whereIn('id', $users);
        if ($user->delete()) {
            echo 'Data Deleted';
        }
    }

    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', $ids)->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::find($id);
        $enabled = $request->get('enabled');
        $user->enabled = $enabled;
        $user = $user->save();

        if ($user) {
            return response(['success' => true, "message" => 'Done']);
        }
    }
}
