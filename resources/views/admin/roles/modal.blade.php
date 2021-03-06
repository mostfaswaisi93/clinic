<!-- Role Modal -->
<div class="modal modal-slide-in fade" id="roleModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-lg">
        <form method="POST" class="add-new-record modal-content pt-0" id="roleForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <span id="form_result"></span>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label" for="name">{{ trans('admin.name') }}:</label>
                        <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="{{ trans('admin.name') }}">
                    </div>
                </div>
                <div class="table-responsive border rounded mt-1 mb-1">
                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                        <span class="align-middle">{{ trans('admin.permissions') }}</span>
                    </h6>
                    @php
                    $models = ['users', 'services', 'countries', 'cities'];
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