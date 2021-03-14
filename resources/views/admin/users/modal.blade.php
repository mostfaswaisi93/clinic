<!-- User Modal -->
<div class="modal modal-slide-in fade" id="userModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-lg">
        <form method="POST" class="add-new-record modal-content pt-0" id="userForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <span id="form_result"></span>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label" for="first_name">{{ trans('admin.first_name') }}:</label>
                        <input id="first_name" type="text" name="first_name" class="form-control"
                            value="{{ old('first_name') }}" placeholder="{{ trans('admin.first_name') }}">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="last_name">{{ trans('admin.last_name') }}:</label>
                        <input id="last_name" type="text" name="last_name" class="form-control"
                            value="{{ old('last_name') }}" placeholder="{{ trans('admin.last_name') }}">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="username">{{ trans('admin.username') }}:</label>
                        <input id="username" type="text" name="username" class="form-control"
                            value="{{ old('username') }}" placeholder="{{ trans('admin.username') }}">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="email">{{ trans('admin.email') }}:</label>
                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="{{ trans('admin.email') }}">
                    </div>
                    <div class="form-group col-6 password">
                        <label class="form-label" for="password">{{ trans('admin.password') }}:</label>
                        <input id="password" type="password" name="password" class="form-control"
                            placeholder="{{ trans('admin.password') }}">
                    </div>
                    <div class="form-group col-6 password">
                        <label class="form-label"
                            for="password_confirmation">{{ trans('admin.password_confirmation') }}:</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control" placeholder="{{ trans('admin.password_confirmation') }}">
                    </div>
                </div>
                <div class="table-responsive border rounded mt-1 mb-1">
                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                        <span class="align-middle">{{ trans('admin.permissions') }}</span>
                    </h6>
                    @php
                    $models = ['users', 'services', 'countries', 'cities', 'districts', 'locations', 'roles',
                    'constants', 'patients'];
                    $maps = ['create', 'read', 'update', 'delete', 'print', 'trash'];
                    @endphp
                    <table class="table table-striped table-borderless">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                @foreach ($maps as $map)
                                <th>
                                    {{ trans('admin.' .$map) }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $index => $model)
                            <tr>
                                <td> {{ trans('admin.' .$model) }}</td>
                                @foreach ($maps as $map)
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="permissions[]"
                                            id="{{ $map . '_' . $model }}" value="{{ $map . '_' . $model }}" />
                                        <label class="custom-control-label" for="{{ $map . '_' . $model }}"></label>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <button type="submit" class="btn btn-primary data-submit mr-1" id="action_button" name="action_button"
                    value="Add">
                    {{ trans('admin.save') }}
                </button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    {{ trans('admin.cancel') }}
                </button>
            </div>
        </form>
    </div>
</div>